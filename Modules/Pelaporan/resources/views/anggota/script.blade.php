<script>

  var table;
  var save_method;

 $(document).ready(function () {
   table =  $('#table').DataTable({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/laporan",
 type:"POST",
 data: {
   "_token" : "{{csrf_token()}}"
 }
 },
 columnDefs: [
   {
  
     targets: [ -1 ], //last column
     orderable: false, //set not orderable
     
   },
   {
      targets: 2, // Kolom ke-2
      className: 'text-start'
    }
 ]
});

 })

  function reload_table() {
         table.ajax.reload();
    };

  function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }


     function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-pop').modal('show'); // show bootstrap modal
    $('.modal-title').text('Buat Laporan'); // Set Title to Bootstrap modal title

}



   function edit(id) {

    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    $.ajax({
        url : "/ajax-data-laporan/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {


          
            $('#annm').hide();
            $('[name="uuid"]').val(data.uuid);
            $('[name="id"]').val(data.id);
            $('[name="jenis_pelaporan"]').val(data.jenis_pelaporan).prop('disabled', true);
            $('[name="judul"]').val(data.judul).prop('readonly', true);
            $('[name="isi"]').text(data.isi).prop('readonly', true);
            $('.img-preview').attr('src', data.lampiran);
            
            $('[name="anonim"]').prop('checked', data.anonim === 1);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
          
         
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}




function detail(id) {


$('#form')[0].reset(); // reset form on modals
$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string
$('#btnSave').hide();

$.ajax({
    url : "/ajax-data-laporan/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      
       $('[name="uuid"]').val(data.uuid);
       $('[name="id"]').val(data.id);
       $('[name="jenis_pelaporan"]').val(data.jenis_pelaporan);
       $('[name="judul"]').val(data.judul);
       $('[name="isi"]').text(data.isi);
      //  $('[name="lampiran"]').val(data.lampiran);
       $('.img-preview').attr('src',data.lampiran);
       $('[name="anonim"]').prop('checked', data.anonim === 1);

      

        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('#btnSave').hide();
        $('.modal-title').text('Detail Data'); // Set title to Bootstrap modal title
      
     
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}

function upload(id) {


$('#form')[0].reset(); // reset form on modals
$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string

$.ajax({
    url : "/ajax-upload-bukti-tambahan-laporan-keluhan-anggota/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
        $('[name="uuid"]').val(data.uuid);
        $('[name="id"]').val(data.id);
        $('[name="pelaporan_id"]').val(data.pelaporan_id);
        $('#modal-pop-upload').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title2').text('Upload Bukti'); // Set title to Bootstrap modal title
     
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}


function formatTanggal(dateString) {
  const date = new Date(dateString);

  if (isNaN(date)) return "-"; // antisipasi kalau tanggal tidak valid

  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = date.getFullYear();

  return `${day}-${month}-${year}`;
}


function histori(id) {

$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string


$.ajax({
    url : "/ajax-histori-laporan-keluhan-anggota/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
const dikirim = formatTanggal(data.created_at);
const dibaca = formatTanggal(data.status_baca);
const tenggat = formatTanggal(data.tenggat);
$('.timeline').html(''); // kosongkan timeline dulu

data.forEach(function(item) {

    const statusClassMap = {
       'Menunggu Tanggapan': 'warning',
       'Diproses': 'danger',
       'Selesai': 'success',
       'Pengumpulan Bukti Tambahan': 'info',
       'Penyelidikan Lebih Lanjut': 'primary'
    };

    const statusClass = statusClassMap[item.status] || 'primary';

    // append, bukan html
    $('.timeline').append(`
        <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-${statusClass}"></span>
            <div class="timeline-event">
                <div class="timeline-header mb-3">
                    <h6 class="mb-0">${item.status == 'Menunggu Tanggapan' ? 'Laporan Telah Dibuat' : item.status}</h6>
                    <small class="text-body-secondary">${item.created_at}</small>
                </div>
                <p class="mb-2">Status : ${item.status_baca == 0 ? 'Belum Dibaca' : 'Sudah Dibaca'}</p>
                <p class="mb-0">Tanggapan : ${item.tanggapan == null ? 'Belum Ada Tanggapan' : item.tanggapan}</p>
            </div>
        </li>
    `);
});



         

        $('#modal-pop-histori').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title2').text('Timeline'); // Set title to Bootstrap modal title
     
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}



function save()
   {
       $('#btnSave').text('Menyimpan...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
       var url;
       var formData = new FormData($('#form')[0]);

       if(save_method == 'update') {
           url = "/update-data-laporan-keluhan-anggota";
       }  
       else {
           url = "/buat-laporan-keluhan-anggota";
       }
    
       // ajax adding data to database
      
       $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
           success: function(data)
           {
               if(data.error ) //if success close modal and reload ajax table
               {   printErrorMsg(data.error);
                refreshData();
                Notiflix.Report.failure(
              `Gagal`,
              'di Simpan',
              'Okay',
                )
               }
               else
               {
                $('#modal-pop').modal('hide');
                  
                   Notiflix.Report.success(
              `Berhasil`,
              'di Simpan',
              'Okay',
                )
              refreshData();
               }

               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
              refreshData();
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
                printErrorMsg(jqXHR.responseJSON.errors);
            Notiflix.Report.failure(
              `Error`,
              'di Simpan',
              'Okay',
                )
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }



   function save_upload()
   {
       $('#btnSave3').text('Menyimpan...'); //change button text
       $('#btnSave3').attr('disabled',true); //set button disable 
       var url;
       var formData = new FormData($('#form3')[0]);

 
           url = "/update-data-upload-tambahan-laporan-keluhan-anggota";
       
       
    
       // ajax adding data to database
      
       $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
           success: function(data)
           {
               if(data.error ) //if success close modal and reload ajax table
               {   printErrorMsg(data.error);
                refreshData();
                Notiflix.Report.failure(
              `Gagal`,
              'di Simpan',
              'Okay',
                )
               }
               else
               {
                $('#modal-pop-upload').modal('hide');
                  
                   Notiflix.Report.success(
              `Berhasil`,
              'di Simpan',
              'Okay',
                )
              refreshData();
               }

               $('#btnSave3').text('Simpan'); //change button text
               $('#btnSave3').attr('disabled',false); //set button enable 
              refreshData();
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
                printErrorMsg(jqXHR.responseJSON.errors);
            Notiflix.Report.failure(
              `Error`,
              'di Simpan',
              'Okay',
                )
               $('#btnSave3').text('Simpan'); //change button text
               $('#btnSave3').attr('disabled',false); //set button enable 
    
           }
       });
   }


   function hapus(id) {
    Notiflix.Confirm.show(
        'Konfirmasi',
        'Yakin Hapus Data ?',
        'Yes',
        'No',
     
        function okCb() {
          Notiflix.Loading.circle(),
            $.ajax({
              url : "/delete-data-laporan/" + id,
                type: "GET",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    reload_table();
                    Notiflix.Loading.remove();
                    Notiflix.Report.success(
                        'Berhasil',
                        'Data Berhasil dihapus',
                        'Okay'
                    );
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  Notiflix.Loading.remove();
                    Notiflix.Report.failure(
                        'Error',
                        'Data gagal dihapus',
                        'Okay'
                    );
                    $('#btnSave').text('Simpan'); // change button text
                    $('#btnSave').attr('disabled', false); // enable button
                }
            });
        },
        function cancelCb() {
    
        }
    );
}


function refreshData() {
    page = 1;
    $.ajax({
        url: "/get-laporan-keluhan-anggota",
        type: "GET",
        data: { page: page },
        dataType: "JSON",
        success: function(response) {
            $('#data').html(response.html); // GANTI isi, bukan append
            if (response.html.trim() === '' || !response.next_page) {
                $('#loadMore').hide();
            } else {
                $('#loadMore').show();
                page += 1; // siapin untuk loadMore
            }
            $('#skl').hide();
        },
        error: function() {
            alert('Gagal mengambil data');
        }
    });
}



let page = 1;

function loadData() {
    $.ajax({
        url: "/get-laporan-keluhan-anggota",
        type: "GET",
        data: { page: page },
        dataType: "JSON",
        success: function(response) {
          
            if (response.html.trim() === '') {
                $('#loadMore').hide(); // sembunyikan tombol kalau datanya habis
            } else {
                $('#data').append(response.html);
                page += 1; // Increment page untuk mengambil halaman selanjutnya
                if (!response.next_page) {
                    $('#loadMore').hide(); // sembunyikan tombol jika tidak ada halaman selanjutnya
                }
            }
            $('#skl').hide();
        },
        error: function() {
            alert('Gagal mengambil data');
        }
    });
}

// Load awal
loadData();

// Load saat tombol diklik
$('#loadMore').on('click', function() {
  $('#skl').show();
  loadData();
});



  function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }


 
function previewFile() {

    const file = document.querySelector('#lampiran').files[0];
    const file2 = document.querySelector('#lampiran2').files[0];

    const img = document.getElementById('previewImage');
    const vid = document.getElementById('previewVideo');
    const pdf = document.getElementById('previewPDF');
    const noPic = document.getElementById('no_pic1');

    const img2 = document.getElementById('previewImage2');
    const vid2 = document.getElementById('previewVideo2');
    const pdf2 = document.getElementById('previewPDF2');
    const noPic2 = document.getElementById('no_pic2');

    // RESET PREVIEW 1
    img.style.display = "none";
    vid.style.display = "none";
    pdf.style.display = "none";
    noPic.style.display = "none";

    // RESET PREVIEW 2
    img2.style.display = "none";
    vid2.style.display = "none";
    pdf2.style.display = "none";
    noPic2.style.display = "none";

    /** ================================
     *  PREVIEW 1
     *  ================================
     */
    if (!file) {
        noPic.style.display = "block";
    } else {
        const url = URL.createObjectURL(file);

        if (file.type.startsWith("image/")) {
            img.src = url;
            img.style.display = "block";
        } else if (file.type.startsWith("video/")) {
            vid.src = url;
            vid.style.display = "block";
        } else if (file.type === "application/pdf") {
            pdf.src = url;
            pdf.style.display = "block";
        } else {
            noPic.innerText = "Preview tidak tersedia untuk file ini";
            noPic.style.display = "block";
        }
    }

    /** ================================
     *  PREVIEW 2
     *  ================================
     */
    if (!file2) {
        noPic2.style.display = "block";
        return;
    }

    const url2 = URL.createObjectURL(file2);

    if (file2.type.startsWith("image/")) {
        img2.src = url2;
        img2.style.display = "block";
    } else if (file2.type.startsWith("video/")) {
        vid2.src = url2;
        vid2.style.display = "block";
    } else if (file2.type === "application/pdf") {
        pdf2.src = url2;
        pdf2.style.display = "block";
    } else {
        noPic2.innerText = "Preview tidak tersedia untuk file ini";
        noPic2.style.display = "block";
    }
}

 

  </script>