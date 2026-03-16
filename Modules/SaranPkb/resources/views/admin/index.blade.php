@extends('layouts.main')

@section('content')
  
<style>
    .image-wrapper {
    width: 200px;
    height: 200px;
    border: 1px dashed #aaa;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.no-image-text {
    position: absolute;
    font-size: 14px;
    color: #777;
}

iframe, video {
    max-width: 100%;
    height: auto; /* video bisa pakai height tetap juga misal 500px */
}

</style>
<h1 class="h3 mb-3">Laporan Keluhan</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex">
          <h4 class="card-title"></h4>
          {{-- <a class="btn btn-primary text-white btn-round ms-auto" onclick="add()"><i class="fa fa-plus"></i> Tambah Pendaftar</a>&nbsp; --}}
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="datatables-ajax table table-bordered dataTable" width="100%">
              <thead class="">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Jenis Laporan</th>
                    <th width="25%">Judul</th>
                    <th width="20%">Status</th>
                    {{-- <th width="15%">Status Laporan</th> --}}
                    <th width="10%">Action</th>

                </tr>
              </thead>
              <tbody>
                <tr>      
                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  
  <!-- Edit User Modal -->

  @include('pelaporan::admin.modal')
             
              <!--/ Edit User Modal -->

    <script src="{{ asset('assets-admin/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets-admin/vendor/libs/select2/select2.js')}}"></script>

 
     @include('pelaporan::admin.script')
    
@endsection