@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>

 <div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header fw-semibold">Page</h5>
        <div class="p-3">
        <button class="btn btn-primary" onclick="add()">Tambah</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap p-3">
        <table id="table" class="table table-borderless" style="width:100%">
            <thead class="text-danger">
                <tr>
                    <th class="text-light">No</th>
                    <th class="text-light">City</th>
                    <th class="text-light">Address</th>
                    <th class="text-light">No Hp</th>
                    <th class="text-light">Open Hours</th>
                    <th class="text-light">Aksi</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</div>





<div class="modal fade" id="modal_form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title2">Form Data</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="row">
                        
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">City</label>
                            <input type="text" class="form-control" name="city" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Address</label>
                            <input type="text" class="form-control" name="address" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">No HP</label>
                            <input type="text" class="form-control" name="no_hp" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Open Hours</label>
                            <input type="text" class="form-control" name="open_hours" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Email</label>
                            <input type="text" class="form-control" name="email" />
                        </div>
                        
                        <div class="mb-3 ">
                            <label class="form-label" for="basic-default-message">gmaps</label>
                            <textarea class="form-control" name="gmaps"></textarea>
                            <p class="text-danger">#Isi embed Gmaps dari google maps</p>
                        </div>
                   
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
    var table;
    var save_method;
    
    $(document).ready(function() {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/get-contact",
                type: "POST",
                data: {
                    "_token": "{{csrf_token()}}"
                }
            },
            columnDefs: [{
                
                targets: [-1], //last column
                orderable: false, //set not orderable
            }]
        });
        
    })
    
    function reload_table() {
        table.ajax.reload();
    };
    
    function printErrorMsg(msg) {
        $.each(msg, function(key, value) {
            console.log(key);
            $('.' + key + '_err').text(value);
        });
    }
    
    function add() {
        // alert("asd");
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.order-group').css('display', 'none');
        $('.help-block text-danger').empty(); // clear error string
        $('[name="title"]').removeAttr('readonly');
        $('[name="description"]').removeAttr('readonly');
        $('#btnSave').show();
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Page'); // Set Title to Bootstrap modal title
    }
    
    
    function edit(id) {
        
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#btnSave').show();
        $('[name="city"]').removeAttr('readonly');
        $('[name="address"]').removeAttr('readonly');
        $('[name="open_hours"]').removeAttr('readonly');
        $('[name="no_hp"]').removeAttr('readonly');
        $('[name="gmaps"]').removeAttr('readonly');
        $('[name="email"]').removeAttr('readonly');
        $.ajax({
            url: "/contact/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="city"]').val(data.city);
                $('[name="address"]').val(data.address);
                $('[name="open_hours"]').val(data.open_hours);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="gmaps"]').val(data.gmaps);
                $('[name="email"]').val(data.email);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title2').text('Edit Data'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
    
    
    
    
    function detail(id) {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        
        $.ajax({
            url: "/contact/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="city"]').val(data.city);
                $('[name="address"]').val(data.address);
                $('[name="open_hours"]').val(data.open_hours);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="gmaps"]').val(data.gmaps);
                $('[name="email"]').val(data.email);
                $('[name="city"]').attr('readonly', true);  // Disable editing for 'title' input
                $('[name="address"]').attr('readonly', true);  // Disable editing for 'description'
                $('[name="open_hours"]').attr('readonly', true);  // Disable editing for 'title' input
                $('[name="no_hp"]').attr('readonly', true);  // Disable editing for 'description'
                $('[name="gmaps"]').attr('readonly', true);  // Disable editing for 'description'
                $('[name="email"]').attr('readonly', true);  // Disable editing for 'description'
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('#btnSave').hide();
                $('.modal-title2').text('Detail Data'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
    
    
    
    
    
    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;
        var formData;
        
        if (save_method == 'add') {
            url = "/contact";
            var formData = new FormData($('#form')[0]);
        } else {
            url = "/contact-update";
            var formData = new FormData($('#form')[0]);
        }
        
        // ajax adding data to database
        
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
                    reload_table();
                    Notiflix.Report.failure(
                    `Gagal`,
                    'Data Gagal',
                    'Ditambahkan',
                    )
                } else {
                    $('#modal_form').modal('hide');
                    reload_table();
                    Notiflix.Report.success(
                    `Berhasil`,
                    'Data Berhasil',
                    'Ditambahkan',
                    )
                    
                }
                
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Notiflix.Report.failure(
                `Gagal`,
                'di Approve',
                'Okay',
                )
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
                
            }
        });
    }
    
    function hapus(id) {
        Notiflix.Confirm.show(
        'Konfirmasi',
        'Apakah anda yakin ingin menghapus data ini?',
        'Ya',
        'Batal',
        function okCb() {
            $.ajax({
                url: "/contact/" + id,
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    reload_table();
                    Notiflix.Report.success(
                    'Berhasil',
                    'Data berhasil dihapus',
                    'Oke'
                    );
                },
                error: function() {
                    Notiflix.Report.failure(
                    'Gagal',
                    'Gagal menghapus data',
                    'Oke'
                    );
                }
            });
        },
        function cancelCb() {
            // batal
        }
        );
    }
    
    
    
</script>





@endsection