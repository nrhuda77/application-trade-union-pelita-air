<script type="text/javascript">
var table;
  var save_method;
 $(document).ready(function () {
   table =  $('#table').DataTable ({
   processing: true,
   serverSide: true,
   ajax: { 
     url: "/pendaftaran-anggota",
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

//  $('#t_awal').on('change', function() {
//     reload_table(); // Memuat ulang DataTables saat input tanggal berubah
//   });

//  $('#t_akhir').on('change', function() {
//     reload_table(); // Memuat ulang DataTables saat input tanggal berubah
//   });

 

function add_excel() {
  save_method = 'add';
  $('#form2')[0].reset(); // reset form on modals
  $('#modal-pop-excel').modal('show'); // show bootstrap modal
  $('.modal-title').text('Input Excel Pendaftar'); // Set Title to Bootstrap 
}
  


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


     function approve(id)
{
    save_method = 'approve';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.modal-title').text('Approve Data'); // Set Title to Bootstrap modal title
    $('#photo-preview').hide(); // hide photo preview modal

    $.ajax({
           url : "/ajax-data-pendaftaran-anggota/" + id,
           type: "GET",
           dataType: "JSON",
           
           success: function(data)
           {

            $("#id_pendaftaran").val(id);
            $("#uuid").val(data.uuid);
            $("#nama").val(data.nama);
            $("#nik").val(data.nik);
            $("#alamat").text(data.alamat);
            $("#email").val(data.email);


// SELFIE
if (data.upload_selfie && data.upload_selfie !== "") {
    $('#uploadedAvatar').attr('src', data.upload_selfie).show();
    $('#no_pics1').hide();
} else {
    $('#uploadedAvatar').hide();
    $('#no_pics1').show();
}

// ID CARD
if (data.upload_id_card && data.upload_id_card !== "") {

    $('#uploadedAvatara').attr('src', data.upload_id_card).show();
    $('#no_pics2').hide();
} else {
    
    $('#uploadedAvatara').hide();
    $('#no_pics2').show();
}

            
            $("#status_pendaftaran").val(data.status_pendaftaran);
  

               $('#modal-pop').modal('show');  // show bootstrap modal when complete loaded
               $('.modal-title').text('Approv Data Pendaftar'); // Set title to Bootstrap modal title
               $('#btnSave').show();
               $('#close').show();
             
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

       $('#form2')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
    
       //Ajax Load data from ajax
       $.ajax({
           url : "/ajax-data-pendaftaran-anggota/" + id,
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

           $('[name="persetujuan_iuran"]').prop('checked', data.persetujuan_iuran == 1);
           $('[name="persetujuan_keaktifan"]').prop('checked', data.persetujuan_keaktifan == 1);
           $('[name="persetujuan_ketentuan"]').prop('checked', data.persetujuan_ketentuan == 1);
           $('[name="persetujuan_potong_gaji"]').prop('checked', data.persetujuan_potong_gaji == 1);
               $('#modal-pop2').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Detail Data Pendaftar'); // Set title to Bootstrap modal title

               if(edit == "edit" ){
                   $('#btnSave2').show();
           
               }else{
                   $('#btnSave2').hide();
               }
            
               Notiflix.Block.remove('.blocking');
    
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

       if(save_method == 'approve') {
           url = "/approval-data-pendaftaran-anggota";
           var formData = new FormData($('#form')[0]);
       }  
       else {
           url = "/update-data-pendaftaran-anggota";
           var formData = new FormData($('#form2')[0]);
       }
    
       Notiflix.Loading.arrows();
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
            Notiflix.Loading.remove();
               if(data.error ) //if success close modal and reload ajax table
               {   printErrorMsg(data.error);
                reload_table();
                Notiflix.Report.failure(
              `Gagal`,
              'di Ubah',
              'Okay',
                )
               }
               else
               {
                $('#modal-pop2').modal('hide');
                   reload_table();
                   Notiflix.Report.success(
              `Berhasil`,
              'di Ubah',
              'Okay',
                )
             
               }

               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
    
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
            Notiflix.Loading.remove();
            Notiflix.Report.failure(
              `Gagal`,
              'di Ubah',
              'Okay',
                )
               $('#btnSave').text('Simpan'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable 
    
           }
       });
   }

function save_excel()
  {
    $('#btnSave3').text('Menyimpan...'); //change button text
    $('#btnSave3').attr('disabled',true); //set button disable 
    var url = "/import-data-pendaftaran-anggota";
    var formData = new FormData($('#form3')[0]);
    Notiflix.Block.circle('#lod');
   
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
          Notiflix.Block.remove('#lod');
        if(data.error ) //if success close modal and reload ajax table
        {   printErrorMsg(data.error);
          reload_table();
          Notiflix.Report.failure(
          `Gagal`,
          'di Insert',
          'Okay',
          )
        }
        else
        {
          $('#modal_form').modal('hide');
          reload_table();
          Notiflix.Report.success(
          `Berhasil`,
          'di Insert',
          'Okay',
          )
          
        }
        
        $('#btnSave3').text('Simpan'); //change button text
        $('#btnSave3').attr('disabled',false); //set button enable 
        
        
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          Notiflix.Block.remove('#lod');
        Notiflix.Report.failure(
        `Gagal`,
        'di Insert',
        'Okay',
        )
   
        $('#btnSave3').text('Simpan'); //change button text
        $('#btnSave3').attr('disabled',false); //set button enable 
        
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