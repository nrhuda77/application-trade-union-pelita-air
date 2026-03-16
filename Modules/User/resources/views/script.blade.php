<script>
  
  var table;
  var save_method;
  
  $(document).ready(function () {
    table =  $('#table').DataTable({
      processing: true,
      serverSide: true,
      ajax: { 
        url: "/user-pengguna",
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
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Pengguna'); // Set Title to Bootstrap modal title

}
  
  
  
  function edit(id) {
    
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
    $.ajax({
    url : "/ajax-user-pengguna/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        
         $('[name="id"]').val(data.id);
        $('[name="name"]').val(data.name);
        $('[name="email"]').val(data.email);
        
        $('#btnSave').show(); // show bootstrap modal when complete loaded
        
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
         Notiflix.Block.remove('.blocking');
        
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

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
    $.ajax({
      url : "/ajax-user-pengguna/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
           
        $('[name="id"]').val(data.id);
        $('[name="name"]').val(data.name);
        $('[name="email"]').val(data.email);
        
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('#btnSave').hide();
        $('.modal-title').text('Detail Data'); // Set title to Bootstrap modal title
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
    var formData = new FormData($('#form')[0]);

      Notiflix.Block.arrows('.blocking', 'Please wait...', {
      svgSize: '129px',
      position: 'absolute',
      svgColor: 'rgba(0, 219, 185)',
      zIndex: 9999 // Gerakkan elemen 20px ke atas
      });
    
    if(save_method == 'update') {
      url = "/update-user-pengguna";
    }  
    else {
      url = "/insert-user-pengguna";
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
        if(data.success ) //if success close modal and reload ajax table
        {  
          $('#modal_form').modal('hide');
          reload_table();
          Notiflix.Report.success(
          `Berhasil`,
          'di Update / di Buat',
          'Okay',
          )
        }
        else
        {
           printErrorMsg(data.error);
          reload_table();
          Notiflix.Report.failure(
          `Gagal`,
          'di Update / di Buat',
          'Okay',
          )
          
        }
         Notiflix.Block.remove('.blocking');
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
        
        
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        Notiflix.Report.failure(
        `Gagal`,
        'di Update / di Buat',
        'Okay',
        )
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
         Notiflix.Block.remove('.blocking');
      }
    });
  }
  
  
  
  
  function previewImage() {
  const image = document.querySelector('.upload_selfie'); // Ambil input file
  const imagePreview = document.querySelector('#pic'); // Ambil elemen gambar untuk preview

  // Hapus class d-none dan tambahkan d-block untuk menampilkan gambar
  $('#pic').removeClass('d-none').addClass('d-block');
  
  const oFReader = new FileReader(); // Membaca file yang di-upload
  oFReader.readAsDataURL(image.files[0]); // Baca file sebagai data URL
  
  // Ketika file selesai dibaca
  oFReader.onload = function(oFREvent) {
    imagePreview.src = oFREvent.target.result; // Ganti src gambar dengan file yang di-upload
  }
}

function previewImage2() {
  const image = document.querySelector('.upload_id_card'); // Ambil input file
  const imagePreview = document.querySelector('#pic2'); // Ambil elemen gambar untuk preview

  // Hapus class d-none dan tambahkan d-block untuk menampilkan gambar
  $('#pic2').removeClass('d-none').addClass('d-block');
  
  const oFReader = new FileReader(); // Membaca file yang di-upload
  oFReader.readAsDataURL(image.files[0]); // Baca file sebagai data URL
  
  // Ketika file selesai dibaca
  oFReader.onload = function(oFREvent) {
    imagePreview.src = oFREvent.target.result; // Ganti src gambar dengan file yang di-upload
  }
}

</script>
