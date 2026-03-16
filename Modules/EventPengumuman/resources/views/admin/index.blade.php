@extends('layouts.main')

@section('content')
  
<style>
  .fixed-thumb {
    height: 130px; /* bebas: 180–250px bagus */
    width: 100%;
    object-fit: cover; /* kunci agar gambar tidak melar */
    object-position: center; /* fokus ke tengah */
}


.no-image-text {
    position: absolute;
    font-size: 14px;
    color: #777;
}

.image-wrapper {
    width: 100%;
    max-width: 350px;         /* batas maksimal di layar besar */
    aspect-ratio: 1 / 1;      /* kotak selalu persegi, responsif */
    border: 1px dashed #aaa;
    border-radius: 10px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;         /* supaya preview tidak tumpah */
    margin-top: 10px;
    background: #fafafa;
}

/* Placeholder text */
.no-image-text {
    position: absolute;
    font-size: 14px;
    color: #777;
}

/* Preview styling (gambar, video, pdf) */
.image-wrapper img,
.image-wrapper video,
.image-wrapper embed {
    width: 100%;
    height: 100%;
    object-fit: contain;   /* biar file tetap rapi & proporsional */
    display: none;
}

/* Responsive khusus untuk HP */
@media (max-width: 576px) {
    .image-wrapper {
        max-width: 100%;    /* full width HP */
        aspect-ratio: 1 / 1;
    }
}


.skeleton {
    background-color: #e0e0e0;
    border-radius: 4px;
    animation: pulse 0.7s infinite ease-in-out;
}

/* Pulse animation for skeleton */
@keyframes pulse {
    0% {
        background-color: #e0e0e0;
    }
    50% {
        background-color: #d4d4d4;
    }
    100% {
        background-color: #e0e0e0;
    }
}

/* Specific skeleton styles for different elements */

/* Skeleton for image */
.skeleton-img {
    width: 120%;
    height: 100%;
    border-radius: 8px;
}

/* Skeleton for title */
.skeleton-title {
    width: 60%;
    height: 20px;
    margin-bottom: 10px;
}

/* Skeleton for text content */
.skeleton-text {
    width: 100%;
    height: 14px;
    margin-bottom: 8px;
}

/* Skeleton for timestamp */
.skeleton-timestamp {
    width: 40%;
    height: 12px;
    margin-top: 10px;
}
</style>
<h1 class="h3 mb-3">Laporan Keluhan</h1>

     <div class="col-7 mb-3">
        <a href="#" class="btn btn-sm" style="background-color: rgb(14, 188, 28)!important; color:azure;!important" onclick="add()"><i class="fa fa-plus"></i> Tambah Data</a>&nbsp;
      </div>

<div id="data" class="row "></div>
<div id="skl" class="row blocking">

  @for ($i = 0; $i < 4; $i++)
  
  <div class="col-md-3">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <!-- Skeleton Loader for Image -->
                <div class="skeleton skeleton-img"></div>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <!-- Skeleton Loader for Title -->
                    <div class="skeleton skeleton-title"></div>
                    <!-- Skeleton Loader for Text -->
                    <div class="skeleton skeleton-text"></div>
                    <div class="skeleton skeleton-text"></div>
                    <!-- Skeleton Loader for Timestamp -->
                    <div class="skeleton skeleton-timestamp"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endfor                

  </div>



<button id="loadMore" class="btn btn-primary mt-3">Read More</button>
  
  <!-- Edit User Modal -->

  @include('eventpengumuman::admin.modal')
             
              <!--/ Edit User Modal -->

    <script src="{{ asset('assets-admin/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets-admin/vendor/libs/select2/select2.js')}}"></script>

 
     @include('eventpengumuman::admin.script')
    
@endsection