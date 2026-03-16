@extends('layouts.main-user')

@section('content')
<link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>

<div class="card">
  <h5 class="card-header">Table Basic</h5>
  <div class="card-body">
    
    <!-- Alert full-width di semua ukuran layar -->
  

    @if ($data?->status == 1 || $data?->status == '1')
    <div class="alert alert-danger" role="alert">
      Anda sudah mengunduh PDF ini. Hubungi admin jika Anda membutuhkan bantuan.
    </div>

    @else
      <div class="alert alert-warning" role="alert">
     <i class="bx bx-info-circle"></i>  <strong>Harap diperhatikan:</strong> PDF ini hanya bisa diunduh satu kali demi alasan keamanan dokumen.<br>
      Pastikan Anda menyimpannya dengan benar setelah mengunduh, karena tautan tidak akan tersedia lagi.<br>
      Dokumen ini dilindungi oleh password untuk membukanya, silahkan gunakan NIP untuk membuka password.
    </div>
       <!-- Tombol download -->
    <a id="downloadBtn" href="/download/pdf-pkb" class="btn btn-sm" 
       style="background-color: rgb(14, 188, 28); color: azure;">
       Download Perjanjian Kerja Bersama (PKB)
    </a>
    @endif
    

  </div>
</div>


  




  <script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script>

  </script>



      

@endsection



