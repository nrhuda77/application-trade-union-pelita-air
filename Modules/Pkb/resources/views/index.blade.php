@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>

<div class="card">
  <h5 class="card-header">PKB </h5>
  <div class="table-responsive text-nowrap p-3">
    <div class="col-lg-12 d-flex justify-content-between">
        <form action="/pkb-cetak-admin" method="post">
            @csrf
     <div class=" col-lg-12 mb-3 me-5">
                <label class="form-label" for="basic-default-fullname">Nama</label>
                <select required name="uuid" class="form-control" id="uuid">
                    <option value="">-- Pilih --</option>
                    @foreach ($anggota as $a)
                        <option value="{{ $a->uuid}}">{{ $a->nama }}</option>
                    @endforeach
                </select>
              </div>

              
  </div>
  <div class=" col-lg-6 mb-3">
     
               <button class="btn btn-primary">download</button>
              </div></form>
</div>

</div>


 

<script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
  
  var table;
  var save_method;
  
  $(document).ready(function () {
    table =  $('#table').DataTable({
      processing: true,
      serverSide: true,
      ajax: { 
        url: "/data-anggota-serikat",
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
  

  
  
  function edit(id) {
    
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('#pic').addClass('d-none');
    $('#pic2').addClass('d-none');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    
    $.ajax({
      url : "/ajax-data-anggota-serikat/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        
        
        console.log(data.persetujuan_iuran);
        
        
        $('[name="uuid"]').val(data.uuid);
        $('[name="id"]').val(data.id);
        $('[name="nama"]').val(data.nama);
        $('[name="nik"]').val(data.nik);
        $('[name="nip"]').val(data.nip);
        $('[name="alamat"]').text(data.alamat);
        $('[name="email"]').val(data.email);
        $('[name="no_hp"]').val(data.no_hp);
        $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
        $('[name="tempat_lahir"]').val(data.tempat_lahir);
        if (data.upload_selfie) {
          $('#pic')
            .attr('src', data.upload_selfie)
            .removeClass('d-none')
            .addClass('d-block');
        }

        if (data.upload_id_card) {
          $('#pic2')
            .attr('src', data.upload_id_card)
            .removeClass('d-none')
            .addClass('d-block');
        }
         $('[name="username"]').val(data.username);
        $('[name="status"]').val(data.status);
        
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
    $('#pic').addClass('d-none');
    $('#pic2').addClass('d-none');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    
    $.ajax({
      url : "/ajax-data-anggota-serikat/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        
      
        
        
        $('[name="uuid"]').val(data.uuid);
        $('[name="id"]').val(data.id);
        $('[name="nama"]').val(data.nama);
        $('[name="nik"]').val(data.nik);
        $('[name="nip"]').val(data.nip);
        $('[name="alamat"]').text(data.alamat);
        $('[name="email"]').val(data.email);
        $('[name="no_hp"]').val(data.no_hp);
        $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
        $('[name="tempat_lahir"]').val(data.tempat_lahir);
        if (data.upload_selfie) {
          $('#pic')
            .attr('src', data.upload_selfie)
            .removeClass('d-none')
            .addClass('d-block');
        }

        if (data.upload_id_card) {
          $('#pic2')
            .attr('src', data.upload_id_card)
            .removeClass('d-none')
            .addClass('d-block');
        }
         $('[name="username"]').val(data.username);
        $('[name="status"]').val(data.status);

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
  
  
  
  
  
  function save()
  {
    $('#btnSave').text('Menyimpan...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url = "/update-data-anggota-serikat";
    var formData = new FormData($('#form')[0]);
  
   
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
          reload_table();
          Notiflix.Report.failure(
          `Gagal`,
          'di Approve',
          'Okay',
          )
        }
        else
        {
          $('#modal_form').modal('hide');
          reload_table();
          Notiflix.Report.success(
          `Berhasil`,
          'di Approve',
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
        'di Approve',
        'Okay',
        )
        $('#btnSave').text('Simpan'); //change button text
        $('#btnSave').attr('disabled',false); //set button enable 
        
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





@endsection

