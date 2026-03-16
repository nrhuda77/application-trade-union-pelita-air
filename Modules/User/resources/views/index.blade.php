@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>

 

<h1 class="h3 mb-3">User Pengguna</h1>
<div class="row blocking">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex">
          <h4 class="card-title"></h4>
          <a class="btn btn-primary text-white btn-round ms-auto" onclick="add()"><i class="fa fa-plus"></i> Tambah Pendaftar</a>&nbsp;
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="datatables-ajax table table-bordered dataTable" width="100%">
              <thead class="">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama</th>
                    <th width="20%">Email</th>
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

@include('user::modal')




<script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>


@include('user::script')


@endsection

