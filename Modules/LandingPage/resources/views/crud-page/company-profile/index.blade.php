@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>

 
<div class="card">
    <div class="card-body">
        <div class="title-card mb-3" style="display:flex; justify-content:space-between">
            <h3 class="card-title fw-semibold mb-4">Profile</h3>
            <div>
            <button class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
        </div>
        </div>
        <form action="#" id="form" class="form-horizontal" method="POST">
            <input type="hidden" value="" name="id" id="id" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-md-7">
                            <input name="name" type="text" class="form-control" id="name" value="{{$company->name}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-md-7">
                            <input name="email" type="text" class="form-control" id="email" value="{{$company->email}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Address</label>
                        <!--<div class="col-md-7">-->
                        <!--    <input name="address" type="text" class="form-control" id="address" value="{{$company->address}}">-->
                        <!--    <span class="help-block text-danger"></span>-->
                        <!--</div>-->
                         <div class="col-md-7">
                            <textarea name="address" rows="3" class="form-control" id="address">{{$company->address}}</textarea>
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Open Hours</label>
                        <div class="col-md-7">
                            <input name="open_hours" type="text" class="form-control" id="open_hours" value="{{$company->open_hours}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Phone</label>
                        <div class="col-md-7">
                            <input name="phone" type="text" class="form-control" id="phone" value="{{$company->phone}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-sm-6">
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Facebook</label>
                        <div class="col-md-7">
                            <input name="facebook" type="text" class="form-control" id="facebook" value="{{$company->facebook}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Instagram</label>
                        <div class="col-md-7">
                            <input name="instagram" type="text" class="form-control" id="instagram" value="{{$company->instagram}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Linkedin</label>
                        <div class="col-md-7">
                            <input name="linkedin" type="text" class="form-control" id="linkedin" value="{{$company->linkedin}}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    

                   <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-md-7">
                            <textarea name="description" rows="6" class="form-control" id="description">{{$company->description}}</textarea>
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

 
<script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>

<script>
 function save() {
        $('#btnSave').text('Menyimpan...'); // Ubah teks tombol
        $('#btnSave').prop('disabled', true); // Matikan tombol sementara
        var url = "/company"; // URL untuk update data
        var formData = new FormData($('#form')[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.error) //if success close modal and reload ajax table
                {
                    printErrorMsg(data.error);
                    Notiflix.Report.failure(
                    `Gagal`,
                    'Data Gagal',
                    'Ditambahkan',
                    )
                } else {
                    Notiflix.Report.success(
                    `Berhasil`,
                    'Data Berhasil',
                    'Ditambahkan',
                    )
                }
                $('#btnSave').text('Simpan');
                $('#btnSave').prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#btnSave').text('Simpan');
                $('#btnSave').prop('disabled', false);
            }
        });
    }

    function printErrorMsg(msg) {
        $.each(msg, function(key, value) {
            console.log(key);
            $('.' + key + '_err').text(value);
        });
    }

    function imagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function upload() {
        $('#btnSave').text('Menyimpan...'); // Ubah teks tombol
        $('#btnSave').prop('disabled', true); // Matikan tombol sementara

        var url = "/company-upload"; // URL untuk update data

        var formData = new FormData($('#form-upload')[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.error) //if success close modal and reload ajax table
                {
                    printErrorMsg(data.error);
                    Notiflix.Report.failure(
                    `Gagal`,
                    'Data Gagal',
                    'Ditambahkan',
                    )
                } else {
                    Notiflix.Report.success(
                    `Berhasil`,
                    'Data Berhasil',
                    'Ditambahkan',
                    )
                }
                $('#btnSave').text('Simpan');
                $('#btnSave').prop('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#btnSave').text('Simpan');
                $('#btnSave').prop('disabled', false);
            }
        });
    }
</script>



 


@endsection

