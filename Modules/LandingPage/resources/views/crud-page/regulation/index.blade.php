@extends('layouts.main')
@section('content')
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header fw-semibold">Regulation</h5>
        <div class="p-3">
        <button class="btn btn-primary" onclick="add()">Tambah</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap p-3">
        <table id="table" class="table table-borderless" style="width:100%">
            <thead class="text-danger">
                <tr>
                    <th class="text-light">No</th>
                    <th class="text-light">Pdf</th>
                    <th class="text-light">Title</th>
                    <th class="text-light">Category</th>
                    <th class="text-light">Description</th>
                    <!-- <th class="text-light">Meta Desc</th> -->
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





<div class="modal " id="modal_form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <label class="form-label" for="basic-default-fullname">Title</label>
                            <input type="text" class="form-control" name="title" />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Category</label>
                            {{-- <input type="text" class="form-control" name="category" /> --}}
                            <select name="category" id="category" class="form-control">
                                <option value="undang-undang">Undang Undang</option>
                                <option value="pemerintah">Peraturan Pemerintah</option>
                                <option value="menteri">Peraturan Menteri</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 ">
                            <label class="form-label" for="basic-default-message">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Upload PDF</label>
                            <input type="file" class="form-control banner" onchange="previewImage()" name="file" />
                            <iframe id="file-pdf" src="" class="d-none mx-auto rounded mt-3" width="100%" height="500px" frameborder="0"></iframe>
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

<!-- Modal untuk melihat PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Lihat PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- iframe untuk menampilkan PDF -->
                <iframe id="pdfViewer" src="" width="100%" height="500px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script>
    var table;
    var save_method;
    
    $(document).ready(function() {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/get-regulation",
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
        $('#file-pdf').addClass('d-none');
        $('[name="title"]').removeAttr('readonly');
        $('[name="category"]').removeAttr('readonly');
        $('[name="description"]').removeAttr('readonly');
        $('[name="file"]').removeAttr('disabled');
        $('[name="file"]').removeAttr('disabled');
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Regulation'); // Set Title to Bootstrap modal title
    }
    
    
    
    function edit(id) {
        
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('#file-pdf').addClass('d-none');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        
        
        $('[name="title"]').removeAttr('readonly');
        $('[name="category"]').removeAttr('readonly');
        $('[name="description"]').removeAttr('readonly');
        $('[name="file"]').removeAttr('disabled');
        $.ajax({
            url: "/regulation/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);
                $('[name="category"]').val(data.category);
                $('[name="description"]').text(data.description);
                if (data.file) {
                    $('#file-pdf')
                    .attr('src', data.file)
                    .removeClass('d-none')
                    .addClass('d-block');
                    $('#file-pdf').attr('src', data.file);
                }
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
        $('#file-pdf').addClass('d-none');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        
        $.ajax({
            url: "/regulation/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);
                $('[name="category"]').val(data.category);
                $('[name="description"]').text(data.description);
                if (data.file) {
                    $('#file-pdf')
                    .attr('src', data.file)
                    .removeClass('d-none')
                    .addClass('d-block');
                    $('#file-pdf').attr('src', data.file);
                }
                $('[name="title"]').attr('readonly', true);  // Disable editing for 'title' input
                $('[name="category"]').attr('readonly', true);  // Disable editing for 'category'
                $('[name="description"]').attr('readonly', true);  // Disable editing for 'description'
                $('[name="file"]').attr('disabled', true);  // Disable file upload input
                
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
            url = "/regulation";
            var formData = new FormData($('#form')[0]);
        } else {
            url = "/regulation-update";
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
                url: "/regulation/" + id,
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
    
    
    function viewPdf(id) {
        $.ajax({
            url: "/regulation/" + id, // URL untuk mendapatkan data Regulation
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.file) {
                    // URL untuk melihat PDF
                    var pdfUrl = data.file;

                    // Tampilkan modal dengan PDF
                    $('#pdfModal').modal('show');
                    $('#pdfViewer').attr('src', pdfUrl);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error mendapatkan data');
            }
        });
    }
    
    
    
    function previewImage() {
        const image = document.querySelector('.banner'); // Ambil input file
        const imagePreview = document.querySelector('#file-pdf'); // Ambil elemen gambar untuk preview
        
        // Hapus class d-none dan tambahkan d-block untuk menampilkan gambar
        $('#file-pdf').removeClass('d-none').addClass('d-block');
        
        const oFReader = new FileReader(); // Membaca file yang di-upload
        oFReader.readAsDataURL(image.files[0]); // Baca file sebagai data URL
        
        // Ketika file selesai dibaca
        oFReader.onload = function(oFREvent) {
            imagePreview.src = oFREvent.target.result; // Ganti src gambar dengan file yang di-upload
        }
    }
    
    
</script>





@endsection