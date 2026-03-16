 <script>

  var table;
  var save_method;

 $(document).ready(function () {
   table =  $('#table').DataTable({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/dashboard-event-pengumuman",
 type:"POST",
 data: {
   "_token" : "{{csrf_token()}}"
 }
 },
 columnDefs: [
   {
  
     targets: [ -1 ], //last column
     orderable: false, //set not orderable
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



let page = 1;

function loadData() {
    $.ajax({
        url: "/dashboard-event-pengumuman",
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


function edit(id) {


$('#form')[0].reset(); // reset form on modals
$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string
 $('.img-preview').attr('src', '');

 save_method = 'update';

$.ajax({
    url : "/ajax-data-event-pengumuman/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      
               
       $('[name="uuid"]').val(data.uuid);
       $('[name="id"]').val(data.id);
       $('#judul').val(data.judul);
       $('#isi').text(data.isi);
       $('#kategori').val(data.kategori);
       $('#waktu_event').val(data.waktu_event);
       $('#lokasi_event').val(data.lokasi_event);
       $('#visibillitas').val(data.visibillitas);
       $('#status').val(data.status);
    

     if (data.lampiran == null) {
       $('.img-preview').attr('src', '');
     }else{
       $('.img-preview').attr('src', 'http://127.0.0.1:8000/' + data.lampiran);
     }

      
       $('[name="anonim"]').prop('checked', data.anonim === 1);

      

        $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
        $('#btnSave').hide();
        $('.modal-title').text('Detail Data'); // Set title to Bootstrap modal title
      
     
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

$.ajax({
    url : "/ajax-data-event-pengumuman/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      
               
       $('[name="uuid"]').val(data.uuid);
       $('[name="id"]').val(data.id);
       $('#jenis_pelaporan').val(data.jenis_pelaporan);
       $('#judul').val(data.judul);
       $('#isi').text(data.isi);
       $('[name="lampiran"]').val(data.lampiran);
      
       $('[name="anonim"]').prop('checked', data.anonim === 1);

      

        $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
        $('#btnSave').hide();
        $('.modal-title').text('Detail Data'); // Set title to Bootstrap modal title
      
     
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
       var formData;

       if(save_method == 'add') {
           url = "/create-event-pengumuman";
           var formData = new FormData($('#form')[0]);
       }  
       else {
           url = "/update-data-event-pengumuman";
           var formData = new FormData($('#form')[0]);
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
                          page = 1;
                   $('#data').html('');
                   $('#loadMore').show();
                   loadData();
                Notiflix.Report.failure(
              `Gagal`,
              'di input',
              'Okay',
                )
               }
               else
               {
                $('#modal-pop').modal('hide');
                             page = 1;
                   $('#data').html('');
                   $('#loadMore').show();
                   loadData();
                   Notiflix.Report.success(
              `Berhasil`,
              'di input',
              'Okay',
              
                )
             
               }

               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
            Notiflix.Report.failure(
              `Gagal`,
              'di input',
              'Okay',
                )
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }



   function previewImage(){
 const image = document.querySelector('#lampiran');
 const imagePreview = document.querySelector('#pic');

 imagePreview.style.display = 'block';

 const oFReader = new FileReader();
 oFReader.readAsDataURL(image.files[0]);

 oFReader.onload = function(oFREvent) {
     imagePreview.src = oFREvent.target.result;
 }
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
              url : "/delete-data-event/" + id,
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
                        'Okay',
                         function () {
                            location.reload(); // ✅ Refresh page setelah klik “Okay”
                        }
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

  </script>