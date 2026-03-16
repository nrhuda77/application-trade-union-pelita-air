<script type="text/javascript">
var table;
  var save_method;
 $(document).ready(function () {
   table =  $('#table').DataTable ({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/laporan-keluhan",
 type:"POST",
data: function (d) {
                // Menambahkan data t_awal dan t_akhir ke request
                d._token = "{{ csrf_token() }}"; // Menyertakan token CSRF
                // d.t_awal = $('#t_awal').val(); // Ambil nilai dari input tanggal awal
                // d.t_akhir = $('#t_akhir').val(); // Ambil nilai dari input tanggal akhir
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

  




        Notiflix.Confirm.init({
className: 'notiflix-confirm',
width: '300px',
zindex: 4003,
position: 'center',
distance: '10px',
backgroundColor: '#f8f8f8',
borderRadius: '25px',
backOverlay: true,
backOverlayColor: 'rgba(0,0,0,0.5)',
rtl: false,
fontFamily: 'Quicksand',
cssAnimation: true,
cssAnimationDuration: 300,
cssAnimationStyle: 'fade',
plainText: true,
titleColor: '#DC143C',
titleFontSize: '16px',
titleMaxLength: 34,
messageColor: '#1e1e1e',
messageFontSize: '14px',
messageMaxLength: 110,
buttonsFontSize: '15px',
buttonsMaxLength: 34,
okButtonColor: '#f8f8f8',
okButtonBackground: '#DC143C',
cancelButtonColor: '#f8f8f8',
cancelButtonBackground: '#a9a9a9',
});



function reload_table()
   {
      table.ajax.reload(null,false); //reload datatable ajax
   }


  function printErrorMsg (msg) {
         $.each( msg, function( key, value ) {
         console.log(key);
           $('.'+key+'_err').text(value);
         });
     }


     function tanggapan(id) {


$('#form')[0].reset(); // reset form on modals
$('.form-group').removeClass('has-error'); // clear error class
$('.help-block').empty(); // clear error string
save_method = 'proses';

$.ajax({
    url : "/ajax-data-laporan-keluhan/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      
      let tenggat = new Date(data[0].tenggat); // pastikan format ISO: "2025-11-22"

const bulan = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

let tanggalFormatted = `${tenggat.getDate()} ${bulan[tenggat.getMonth()]} ${tenggat.getFullYear()}`;



               
       $('[name="uuid"]').val(data[0].uuid);
       $('[name="id"]').val(data[0].id);
       $('[name="status"]').val(data[0].status);
       $('#jenis_pelaporan').html(data[0].jenis_pelaporan);
       $('#judul').html(data[0].judul);
       $('#tenggat').html('<i class="icon-base text-danger ti tabler-calendar-week me-2 align-bottom"></i>Tenggat : '+tanggalFormatted);
      
       $('#isi').html(data[1].isi ?? '-');
      let lampiranUrl = data[1].lampiran ?? ''; // URL file
      let ext = lampiranUrl.split('.').pop().toLowerCase(); // ambil ekstensi
      let lampiranContainer = $('#lampiran-container'); // container khusus      
     
      if(data[0].status == 'Pengumpulan Bukti Tambahan' && lampiranUrl == ''){
        $('#stts').html('<i class="icon-base text-primary ti tabler-notification me-2 align-bottom"></i>Status : '+data[0].status + ' (File Belum Di Upload)');
       }else{
         $('#stts').html('<i class="icon-base text-primary ti tabler-notification me-2 align-bottom"></i>Status : '+data[0].status);
       }



// kosongkan dulu container
lampiranContainer.empty();

if(['jpg','jpeg','png','gif','webp'].includes(ext)) {
    lampiranContainer.append(`<img src="${lampiranUrl}" class="img-fluid w-100 rounded" alt="Lampiran">`);
} else if(['mp4','webm','ogg'].includes(ext)) {
    lampiranContainer.append(`
        <video class="w-100 rounded" controls>
            <source src="${lampiranUrl}" type="video/${ext}">
            Your browser does not support the video tag.
        </video>
    `);
} else if(['pdf','doc','docx','xls','xlsx','ppt','pptx'].includes(ext)) {
    lampiranContainer.append(`
        <iframe src="${lampiranUrl}" class="w-100" style="height:600px;" frameborder="0"></iframe>
    `);
} else {
    lampiranContainer.append(`<p>Gambar tidak tersedia</p>`);
}

       if(data[0].anonim == 1){
        $('#anonim').html('<i class="text-success icon-base ti tabler-spy me-2 align-bottom"></i>Pengirim : Anonim');
       }else{
        $('#anonim').html('<i class="text-success icon-base ti tabler-spy me-2 align-bottom"></i>Pengirim : '+data[2].nama);
       }
       

      

        $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
        $('#btnSave').hide();
        $('.modal-title').text('Detail Tanggapan'); // Set title to Bootstrap modal title


           $.ajax({
            url : "/update-read-laporan-keluhan/" + id,
            type: "GET",
            dataType: "JSON",
           success: function(data)
           {
                // if(data.status_baca !== null){
                  
                // }else{
                //   Notiflix.Report.success('Success', 'Data telah dibaca', 'Okay');
                // }
reload_table();
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
            Notiflix.Report.failure(
              `Error`,
              '',
              'Okay',
                )
    
           }
       });
      
     
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}

      function detail(id, edit)
   {

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });

       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-anggota-serikat/" + id,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {

         $('[name="uuid"]').val(data.uuid);
        $('[name="id"]').val(id);
        $('[name="nama"]').val(data.nama);
        $('[name="nik"]').val(data.nik);
        $('[name="nip"]').val(data.nip);
        $('[name="alamat"]').text(data.alamat);
        $('[name="email"]').val(data.email);
        $('[name="no_hp"]').val(data.no_hp);
        $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
        $('[name="tempat_lahir"]').val(data.tempat_lahir);
         $('[name="username"]').val(data.username);
        $('[name="status"]').val(data.status);
         // SELFIE
if (data.upload_selfie && data.upload_selfie !== "") {
    $('#pic').attr('src', data.upload_selfie).show();
    $('#no_pic1').hide();
} else {
    $('#pic').hide();
    $('#no_pic1').show();
}

// ID CARD
if (data.upload_id_card && data.upload_id_card !== "") {
    $('#pic2').attr('src', data.upload_id_card).show();
    $('#no_pic2').hide();
} else {
    $('#pic2').hide();
    $('#no_pic2').show();
}
 
               $('#modal-pop').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pendaftar'); // Set title to Bootstrap modal title

               
            
                   $('#btnSave').show();
           
               
            
               Notiflix.Block.remove('.blocking');
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               alert('Error get data from ajax');
           }
       });
   }

 
   function proses(value) {
    $('#btnSave').text('Menyimpan...'); // Ubah teks tombol
    $('#btnSave').attr('disabled', true); // Nonaktifkan tombol

    var url = "/update-data-laporan-keluhan";
    
    var formData = new FormData($('#form')[0]);
    formData.append('value', value); // Kirim value tambahan ke server

    // Kirim data via AJAX
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data) {
            if (data.error) {
                printErrorMsg(data.error);
                reload_table();
                Notiflix.Report.failure('Gagal', 'di Tanggapi', 'Okay');
            } else {
                $('#modal_form').modal('hide');
                reload_table();
                Notiflix.Report.success('Berhasil', 'di Tanggapi', 'Okay');
            }

            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Notiflix.Report.failure('Gagal', 'di Tanggapi', 'Okay');
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false);
        }
    });
}



      function previewImage(){
 const image = document.querySelector('.upload_selfie');
 const imagePreview = document.querySelector('#pic');

 imagePreview.style.display = 'block';

 const oFReader = new FileReader();
 oFReader.readAsDataURL(image.files[0]);

 oFReader.onload = function(oFREvent) {
     imagePreview.src = oFREvent.target.result;
 }
}


function previewImage2(){
 const image = document.querySelector('.upload_id_card');
 const imagePreview = document.querySelector('#pic2');

 imagePreview.style.display = 'block';

 const oFReader = new FileReader();
 oFReader.readAsDataURL(image.files[0]);

 oFReader.onload = function(oFREvent) {
     imagePreview.src = oFREvent.target.result;
 }
}

  </script>