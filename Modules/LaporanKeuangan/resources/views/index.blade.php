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
</style>
<h1 class="h3 mb-3">Pendaftaran Anggota</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex">
          <h4 class="card-title"></h4>
          <a class="btn btn-primary text-white btn-round ms-auto" onclick="add_excel()"><i class="fa fa-plus"></i> Input Excel Pendaftar</a>&nbsp;
        </div>
        <div class="card-body">
          <div class="table-responsive">
              {{-- <form action="#" id="filterForm" class="form-horizontal">
                <div class="form-body">   
                  <div class="form-group row mb-5">
                <div class="col-md-4 mt-3">
                     <label class="control-label text-dark" style="font-weight:bolder;">Tanggal Awal</label>
                     <input name="t_awal" id="t_awal"  class="form-control" type="date" value="{{ date('Y-m-d') }}">
                       <span class="help-block"></span>
                </div>
  
                 <div class="col-md-4 mt-3">
                      <label class="control-label text-dark" style="font-weight:bolder;">Tanggal Akhir</label>
                      <input name="t_akhir" id="t_akhir" class="form-control" type="date" value="{{ date('Y-m-d') }}">
                      <span class="help-block"></span>
                </div>
                </div>
                </div>
            </form> --}}
            <table id="table" class="datatables-ajax table table-bordered dataTable" width="100%">
              <thead class="">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama</th>
                    <th width="25%">Nik</th>
                    <th width="20%">Email</th>
                    <th width="15%">Status</th>
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

  @include('laporankeuangan::admin.modal')
             
              <!--/ Edit User Modal -->

    <script src="{{ asset('assets-admin/vendor/libs/jquery/jquery.js') }}"></script>
     <script src="{{asset('assets-admin/vendor/libs/select2/select2.js')}}"></script>

 
     @include('laporankeuangan::admin.script')
    
@endsection