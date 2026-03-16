@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
<script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>

<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header fw-semibold">Organization</h5>
        <div class="p-3">
        <button class="btn btn-primary" onclick="add()">Tambah</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap p-3">
        <table id="table" class="table table-borderless" style="width:100%">
            <thead class="text-danger">
                <tr>
                    <th class="text-light">No</th>
                    <th class="text-light">Banner</th>
                    <th class="text-light">Structure</th>
                    <th class="text-light">Title</th>
                    {{-- <th class="text-light">Description</th> --}}
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
                <h3 class="modal-unit_name2">Form Data</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="row">
                        
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Unit Name</label>
                            <input type="text" class="form-control" name="unit_name" />
                        </div>
                        
                        <div class="mb-3 ">
                            <label class="form-label" for="basic-default-message">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            <div id="live-preview" class="border mt-3 p-3"></div>
                        </div>
                    
                        
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Upload Banner</label>
                            <input type="file" class="form-control banner" onchange="previewImage()" name="banner" />
                            <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" alt="user-avatar" class="d-none mx-auto rounded img-preview mt-3" height="200" width="200" id="banner" />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Upload Structure Image</label>
                            <input type="file" class="form-control structure_image" onchange="previewImage2()" name="structure_image" />
                            <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" alt="user-avatar" class="d-none mx-auto rounded img-preview mt-3" height="200" width="200" id="structure_image" />
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

<!-- Modal Edit HTML -->
<div class="modal fade" id="htmlModal" tabindex="-1" aria-labelledby="htmlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit HTML</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <textarea id="raw-html-editor" class="form-control" rows="10"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" id="save-html" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
  



<script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('template/admin/assets/vendor/libs/tinymce/tinymce.min.js') }}"></script>
<script>
     tinymce.init({
  selector: '#description',
  height: 300,
  plugins: 'lists paste',
  toolbar: 'undo redo | bold italic underline | bullist numlist | alignleft aligncenter alignright alignjustify | editHtmlBtn',
  menubar: false,
  setup: function (editor) {
    editor.ui.registry.addButton('editHtmlBtn', {
      tooltip: 'Edit HTML',
      text: '✏️ HTML', // emoji pensil, simple banget
      onAction: function () {
        const content = editor.getContent();
        document.getElementById('raw-html-editor').value = content;

        const modal = new bootstrap.Modal(document.getElementById('htmlModal'));
        modal.show();

        document.getElementById('save-html').onclick = function () {
          const updatedHtml = document.getElementById('raw-html-editor').value;
          editor.setContent(updatedHtml);
          document.getElementById('live-preview').innerHTML = updatedHtml;
        };
      }
    });
  }
});
  </script>

<script>
    var table;
    var save_method;
    
    $(document).ready(function() {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/get-organization",
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
        $('[name="unit_name"]').removeAttr('readonly');
        $('[name="description"]').removeAttr('readonly');
        $('[name="banner"]').removeAttr('disabled');
        $('#banner').addClass('d-none');
        $('#btnSave').show(); 
        $('[name="structure_image"]').removeAttr('disabled');
        $('#structure_image').addClass('d-none');
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-unit_name').text('Tambah Page'); // Set Title to Bootstrap modal unit_name
        setTimeout(function () {
        const editor = tinymce.get('description');
        if (editor) {
            document.getElementById('live-preview').innerHTML = editor.getContent();
        }
    }, 500); // kasih delay agar modal tampil dulu
    }
    
    
    
    function edit(id) {
        
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('#banner').addClass('d-none');
        $('#banner').attr('src', '');
        $('#structure_image').addClass('d-none');
        $('#structure_image').attr('src', '');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="unit_name"]').removeAttr('readonly');
        $('[name="description"]').removeAttr('readonly');
        $('[name="banner"]').removeAttr('disabled');
        $('#btnSave').show();
        $('[name="structure_image"]').removeAttr('disabled');
        $.ajax({
            url: "/organization/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="unit_name"]').val(data.unit_name);
                tinymce.get('description').setContent(data.description);
                setTimeout(function () {
                    document.getElementById('live-preview').innerHTML = tinymce.get('description').getContent();
                    }, 300);
                if (data.banner) {
                    $('#banner')
                    .attr('src', data.banner)
                    .removeClass('d-none')
                    .addClass('d-block');
                    // $('#banner').attr('src', data.banner);
                }
                if (data.structure_image) {
                    $('#structure_image')
                    .attr('src', data.structure_image)
                    .removeClass('d-none')
                    .addClass('d-block');
                    // $('#structure_image').attr('src', data.structure_image);
                }
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-unit_name2').text('Edit Data'); // Set unit_name to Bootstrap modal unit_name
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
    
    
    
    
    function detail(id) {
        $('#form')[0].reset(); // reset form on modals
        $('#banner').addClass('d-none');
        $('#banner').attr('src', '');
        $('#structure_image').addClass('d-none');
        $('#structure_image').attr('src', '');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "/organization/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="unit_name"]').val(data.unit_name);
                tinymce.get('description').setContent(data.description);
                setTimeout(function () {
                    document.getElementById('live-preview').innerHTML = tinymce.get('description').getContent();
                    }, 300);
                if (data.banner) {
                    $('#banner')
                    .attr('src',data.banner)
                    .removeClass('d-none')
                    .addClass('d-block');
                    // $('#banner').attr('src', data.banner);
                }
                if (data.structure_image) {
                    $('#structure_image')
                    .attr('src',data.structure_image)
                    .removeClass('d-none')
                    .addClass('d-block');
                    // $('#structure_image').attr('src', data.structure_image);
                }
                $('[name="unit_name"]').attr('readonly', true);  // Disable editing for 'unit_name' input
                $('[name="description"]').attr('readonly', true);  // Disable editing for 'description'
                $('[name="banner"]').attr('disabled', true);  // Disable file upload input
                $('[name="structure_image"]').attr('disabled', true);  // Disable file upload input
                
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('#btnSave').hide();
                $('.modal-unit_name2').text('Detail Data'); // Set unit_name to Bootstrap modal unit_name
                
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
    
    
    
    
    
    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 

        tinymce.triggerSave(); // <- Ini yang penting!
        var url;
        var formData;
        
        if (save_method == 'add') {
            url = "/organization";
            var formData = new FormData($('#form')[0]);
        } else {
            url = "/organization-update";
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
                url: "/organization/" + id,
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
    
    
    
    
    
    function previewImage() {
        const image = document.querySelector('.banner'); // Ambil input file
        const imagePreview = document.querySelector('#banner'); // Ambil elemen gambar untuk preview
        
        // Hapus class d-none dan tambahkan d-block untuk menampilkan gambar
        $('#banner').removeClass('d-none').addClass('d-block');
        
        const oFReader = new FileReader(); // Membaca file yang di-upload
        oFReader.readAsDataURL(image.files[0]); // Baca file sebagai data URL
        
        // Ketika file selesai dibaca
        oFReader.onload = function(oFREvent) {
            imagePreview.src = oFREvent.target.result; // Ganti src gambar dengan file yang di-upload
        }
    }
    
    function previewImage2() {
        const image = document.querySelector('.structure_image');
        const imagePreview = document.querySelector('#structure_image');
        
        // Hapus class d-none dan tambahkan d-block untuk menampilkan gambar
        $('#structure_image').removeClass('d-none').addClass('d-block');
        
        const oFReader = new FileReader(); // Membaca file yang di-upload
        oFReader.readAsDataURL(image.files[0]); // Baca file sebagai data URL
        
        // Ketika file selesai dibaca
        oFReader.onload = function(oFREvent) {
            imagePreview.src = oFREvent.target.result; // Ganti src gambar dengan file yang di-upload
        }
    }
    
    
</script>





@endsection