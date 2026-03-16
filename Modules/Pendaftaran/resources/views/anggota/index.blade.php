
<!DOCTYPE html>

<html
lang="en"
class="light-style layout-menu-fixed"
dir="ltr"
data-theme="theme-default"
data-assets-path="template/admin/assets/"
data-template="vertical-menu-template-free"
>
<head>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />
  
  <title>Pendaftaran - System</title>
  
  <meta name="description" content="" />
  
  <!-- Favicon -->
 <link rel="icon" href="https://sppelitaair.org/template/landing/assets/img/logo-srkt.png" type="image/png">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"
  />
  
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/fonts/boxicons.css') }}" />
  
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/css/core2.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('template/admin/assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.css')}}" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  
  <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
  
  <!-- Page CSS -->
  
  <!-- Helpers -->
  <script src="{{ asset('template/admin/assets/vendor/js/helpers.js') }}"></script>
  
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('template/admin/assets/js/config.js') }}"></script>
    
    <script src="{{asset('template/admin/assets/vendor/libs/notiflix/dist/notiflix-3.2.7.min.js')}}"></script>
    
    <style>

      body {
    font-family: Inter, system-ui;

    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    background-image:
      radial-gradient(circle at 20% 20%, rgba(209, 231, 246, 0.15), transparent 60%),
      radial-gradient(circle at 80% 80%, rgba(0,255,200,0.12), transparent 70%);
  }
      #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
      }
      
      #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
      }
      
      .form-card {
        text-align: left
      }
      
      
      
      #msform .action-button {
        width: 100px;
        background: #7367F0;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
      }
      
      #msform .action-button:hover, #msform .action-button:focus {
        background-color: #5E50EE
      }
      
      #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
      }
      
      #msform .action-button-previous:hover, #msform .action-button-previous:focus {
        background-color: #000000
      }
      
      .fs-title {
        font-size: 25px;
        color: #7367F0;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
      }
      
      .purple-text {
        color: #7367F0;
        font-weight: normal
      }
      
      .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
      }
      
      .fieldlabels {
        color: gray;
        text-align: left;
        margin-bottom: 5px;
        font-weight: 500;
      }
      
      /* Progress Bar dengan Icon Langsung */
      #progressbar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        overflow: hidden;
        counter-reset: step;
        padding-left: 0;
      }
      
      #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 33.33%;
        position: relative;
        text-align: center;
        color: #d4d4d4;
      }
      
      #progressbar li .icon-circle {
        width: 50px;
        height: 50px;
        line-height: 50px;
        display: block;
        font-size: 24px;
        color: #ffffff;
        background: #d4d4d4;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        position: relative;
        z-index: 2;
      }
      
      #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: #d4d4d4;
        position: absolute;
        left: -50%;
        top: 25px;
        z-index: 1;
      }
      
      #progressbar li:first-child:after {
        content: none;
      }
      
      #progressbar li.active {
        color: #7367F0;
      }
      
      #progressbar li.active .icon-circle {
        background: #7367F0;
      }
      
      #progressbar li.active:after {
        background: #7367F0;
      }
      
      /* Pastikan fieldset pertama visible */
      #msform fieldset:first-of-type {
        display: block;
      }
      
      #msform fieldset:not(:first-of-type) {
        display: none;
      }
      
      .progress {
        height: 20px
      }
      
      .progress-bar {
        background-color: #7367F0
      }
      
      .fit-image {
        width: 100%;
        object-fit: cover
      }
      
      .img-preview, .img-preview2 {
        border: 1px solid #ddd;
        padding: 5px;
        background-color: #f8f9fa;
      }
    </style>
  </head>
  
  <body>
    
    <body>
      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
          <!-- Layout container -->
          <div class="layout-page">
            <!-- Navbar -->
            <div class="container-xxl flex-grow-1 container-p-y">
              @if ($errors->any())
              <div class="alert alert-danger">
                <strong>Oops! Ada yang salah:</strong>
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
            
            <!-- Content wrapper -->
            <div class="content-wrapper">
              <!-- Content -->
              
              <form id="msform" action="/buat-pendaftaran" method="POST" enctype="multipart/form-data">
                <div class="container">
                  <div class="card">
                    @csrf
                    <div class="card-body">
                      <!-- progressbar -->
                      <ul id="progressbar">
                        <li class="active" id="account">
                          <div class="icon-circle"><i class='bx bx-user'></i></div>
                          <strong>Data Diri</strong>
                        </li>
                        {{-- <li id="personal">
                          <div class="icon-circle"><i class='bx bx-check'></i></div>
                          <strong>Verifikasi</strong>
                        </li> --}}
                        <li id="personal">
                          <div class="icon-circle"><i class='bx bx-camera'></i></div>
                          <strong>Upload Foto</strong>
                        </li>
                        <li id="confirm">
                          <div class="icon-circle"><i class='bx bx-check-circle'></i></div>
                          <strong>Persetujuan</strong>
                        </li>
                      </ul>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                      </div> <br>
                      
                    </div>
                  </div>
                </div>
                
                
                <!-- Account -->
                
                <div class="container-xxl flex-grow-1 container-p-y">
                  <div class="row">
                    <div class="col-lg-12 mb-4 order-0">
                      <div class="col-xxl">
                        
                        <div class="card mb-4">
                          <h5 class="card-header text-center">Form Pendaftaran</h5>
                          <div class="card-body">
                            <p>Isi semua form untuk melanjutkan ke langkah berikutnya</p>
                            
                            <!-- fieldsets -->
                            <fieldset>
                              <div class="form-card">
                                <div class="row">
                                  <div class="col-7">
                                    <h2 class="fs-title">Informasi Data Diri:</h2>
                                  </div>
                                  <div class="col-5">
                                    <h2 class="steps">Step 1 - 3</h2>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Nama Lengkap: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                                      <input value="{{ old('nama') }}" type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama" required/>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">NIP: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class='bx bx-credit-card-front'></i></span>
                                      <input value="{{ old('nip') }}" type="text" name="nip" id="nip" class="form-control" placeholder="Masukan NIP" required/>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-12" style="display:flex;justify-content:center;align-items:center">
                                    <button type="button" class="btn btn-primary bs-gray" onclick="cekData()">Cek Data</button>
                                  </div>
                                  
                                  <!--<div class="mb-3 col-md-6">-->
                                  <!--  <label class="fieldlabels">User Baru Isi Manual:</label>-->
                                  <!--  <div class="form-check form-switch">-->
                                  <!--    <input class="form-check-input" type="checkbox" value="1" name="cek_read" id="cek_read" onclick="cekRead()">-->
                                  <!--  </div>-->
                                  <!--</div>-->
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">NIK: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class='bx bx-id-card'></i></span>
                                      <input value="{{ old('nik') }}"  type="text" name="nik" id="nik" class="form-control" readonly placeholder="Masukan NIK" required/>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Tempat Lahir: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                      <input value="{{ old('tempat_lahir') }}"  type="text" name="tempat_lahir" id="tempat_lahir" readonly class="form-control" placeholder="Masukan Tempat Lahir" required/>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Tanggal Lahir: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                      <input value="{{ old('tanggal_lahir') }}"  type="date" name="tanggal_lahir" id="tanggal_lahir" readonly class="form-control" required/>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Alamat: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-home"></i></span>
                                      <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat" readonly required>{{ old('alamat') }}</textarea>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">No HP: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                      <input value="{{ old('no_hp') }}"  type="text" name="no_hp" id="no_hp" readonly class="form-control" placeholder="Masukan No HP" required/>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Email: *</label>
                                    <div class="input-group input-group-merge">
                                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                      <input value="{{ old('email') }}"  type="email" name="email" id="email" readonly class="form-control" placeholder="Masukan Email Perusahaan" required/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <input type="button" name="next" class="next btn btn-primary" value="Next" />
                            </fieldset>
                            
                            <fieldset>
                              <div class="form-card">
                                <div class="row">
                                  <div class="col-7">
                                    <h2 class="fs-title">Upload Foto:</h2>
                                  </div>
                                  <div class="col-5">
                                    <h2 class="steps">Step 2 - 3</h2>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Foto Selfie: *</label>
                                    <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" alt="user-avatar" class="d-block rounded img-preview mb-2" height="150" width="150" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                      <label for="upload_selfie" class="btn btn-primary me-2 mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload Gambar Selfie</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" onchange="previewImage()" id="upload_selfie" name="upload_selfie" class="account-file-input upload_selfie" hidden accept="image/png, image/jpeg" required/>
                                      </label>
                                      <button type="button" class="btn btn-outline-secondary account-image-reset mb-2" onclick="resetImage()">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                      </button>
                                      <p class="text-muted mb-0">Format: JPG, GIF, atau PNG. Maksimal 800KB</p>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-6">
                                    <label class="fieldlabels">Foto ID Card: *</label>
                                    <img src="https://img.pikbest.com/png-images/20241104/id-card-icon-silhouette-white-background_11055062.png!sw800" alt="user-avatar" class="d-block rounded img-preview2 mb-2" height="150" width="150" id="uploadedAvatar2" />
                                    <div class="button-wrapper">
                                      <label for="upload_id_card" class="btn btn-primary me-2 mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload ID Card</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" onchange="previewImage2()" id="upload_id_card" name="upload_id_card" class="account-file-input upload_id_card" hidden accept="image/png, image/jpeg" required/>
                                      </label>
                                      <button type="button" class="btn btn-outline-secondary account-image-reset mb-2" onclick="resetImage2()">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                      </button>
                                      <p class="text-muted mb-0">Format: JPG, GIF, atau PNG. Maksimal 800KB</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <input type="button" name="previous" class="previous btn btn-primary" value="Previous" />
                              <input type="button" name="next" class="next btn btn-primary" value="Next" />
                            </fieldset>
                            
                            <fieldset>
                              <div class="form-card">
                                <div class="row">
                                  <div class="col-7">
                                    <h2 class="fs-title">Persetujuan:</h2>
                                  </div>
                                  <div class="col-5">
                                    <h2 class="steps">Step 3 - 3</h2>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" name="persetujuan_iuran" id="persetujuan_iuran" required>
                                      <label class="form-check-label fieldlabels" for="persetujuan_iuran">Saya setuju membayar iuran</label>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" name="persetujuan_keaktifan" id="persetujuan_keaktifan" required>
                                      <label class="form-check-label fieldlabels" for="persetujuan_keaktifan">Saya setuju untuk tetap aktif</label>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" name="persetujuan_ketentuan" id="persetujuan_ketentuan" required>
                                      <label class="form-check-label fieldlabels" for="persetujuan_ketentuan">Saya menyetujui ketentuan berlaku</label>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-3 col-md-12">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" name="persetujuan_potong_gaji" id="persetujuan_potong_gaji" required>
                                      <label class="form-check-label fieldlabels" for="persetujuan_potong_gaji">Saya menyetujui pemotongan gaji</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <input type="button" name="previous" class="previous btn btn-primary" value="Previous" />
                              <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
                            </fieldset>

                            


                           <div class="modal" id="modal_form" data-backdrop="static" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Terms & Service</h3>
      </div>
      <div class="card overflow-hidden mb-4" style="height: 500px;">
        <h5 class="card-header">Privacy Policy</h5>
        <div class="card-body" id="vertical-example" style="overflow-y: auto; text-align: justify;">
          
          <p><strong>📄 Kebijakan Privasi</strong></p>
          <p><strong>Serikat Pekerja Pelita Air</strong></p>
          <!--<p><strong>Terakhir diperbarui: 28 Agustus 2025</strong></p>-->

          <p>Serikat Pekerja Pelita Air menghargai privasi dan perlindungan data pribadi seluruh anggotanya. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi Anda dalam proses keanggotaan dan penggunaan layanan kami melalui website resmi.</p>

          <hr>
          <p><strong>1. Informasi yang Kami Kumpulkan</strong></p>
          <ul>
            <li>Nama lengkap</li>
            <li>Nomor Induk Pegawai (NIP)</li>
            <li>Alamat email</li>
            <li>Nomor telepon</li>
            <li>Foto selfie</li>
            <li>Foto identitas (ID Card / Kartu Pegawai)</li>
            <li>Data pekerjaan (jabatan, unit kerja)</li>
            <li>Informasi keanggotaan dan preferensi pembayaran iuran</li>
          </ul>

          <hr>
          <p><strong>2. Tujuan Pengumpulan Data</strong></p>
          <ul>
            <li>Verifikasi identitas dan keanggotaan</li>
            <li>Proses pendaftaran dan administrasi anggota</li>
            <li>Komunikasi resmi dari Serikat Pekerja</li>
            <li>Pengelolaan iuran dan hak keanggotaan</li>
            <li>Peningkatan pelayanan dan sistem informasi keanggotaan</li>
          </ul>

          <hr>
          <p><strong>3. Penyimpanan dan Keamanan Data</strong></p>
          <p>Data Anda disimpan dalam sistem yang aman dan hanya dapat diakses oleh pihak berwenang di Serikat Pekerja Pelita Air.</p>
          <p>Kami menerapkan perlindungan teknis dan organisasi sesuai dengan standar keamanan informasi untuk mencegah akses tidak sah, kebocoran data, atau penyalahgunaan.</p>

          <hr>
          <p><strong>4. Pembagian Informasi</strong></p>
          <p>Kami tidak akan menjual atau menyewakan data pribadi Anda kepada pihak ketiga.</p>
          <p>Data hanya akan dibagikan apabila:</p>
          <ul>
            <li>Diperlukan oleh hukum atau peraturan pemerintah</li>
            <li>Dibutuhkan oleh institusi resmi internal perusahaan untuk tujuan administratif kepegawaian (dengan izin Anda)</li>
            <li>Telah mendapat persetujuan eksplisit dari Anda</li>
          </ul>

          <hr>
          <p><strong>5. Persetujuan Anda</strong></p>
          <p>Dengan mendaftar dan menggunakan layanan kami, Anda menyatakan telah membaca, memahami, dan menyetujui Kebijakan Privasi ini.</p>

          <hr>
          <p><strong>6. Perubahan Kebijakan</strong></p>
          <p>Kami dapat memperbarui Kebijakan Privasi ini sewaktu-waktu. Perubahan akan diumumkan melalui website resmi kami dan mulai berlaku segera setelah dipublikasikan.</p>

          <!--<hr>-->
          <!--<p><strong>7. Kontak Kami</strong></p>-->
          <!--<p>Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini atau ingin mengakses, memperbarui, atau menghapus data pribadi Anda, silakan hubungi:</p>-->
          <!--<p>-->
          <!--  Email: <a href="mailto:serikat@pelitaair.co.id">serikat@pelitaair.co.id</a><br>-->
          <!--  Alamat: Kantor Serikat Pekerja Pelita Air, [Alamat Lengkap]<br>-->
          <!--  Telepon: [Nomor Telepon]-->
          <!--</p>-->

          <hr>
          <div class="form-check mt-3">
            <input type="checkbox" id="myCheck" onclick="verifyCheck()" class="form-check-input">
            <label for="myCheck" class="form-check-label">Saya Telah Membaca dan Setuju dengan Aturan Ini</label>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="verify" name="verify" value="">
        <button type="button" id="close" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- / Content -->
              </div>
              <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
          </div>
          
          <!-- Overlay -->
          <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        
        
        
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('template/admin/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('template/admin/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('template/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('template/admin/assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('template/admin/assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->
        
        <!-- Vendors JS -->
        <script src="{{ asset('template/admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        
        <!-- Main JS -->
        <script src="{{ asset('template/admin/assets/js/main.js') }}"></script>
        
        <!-- Page JS -->
        <script src="{{ asset('template/admin/assets/js/dashboards-analytics.js') }}"></script>
        
        <!-- Place this tag in your head or just before your close body tag. -->
        
        
        
        <script>
          document.addEventListener("DOMContentLoaded", function () {
            Notiflix.Loading.remove(); // Matikan loading saat page load
            
            document.getElementById("formPendaftaran").addEventListener("submit", function() {
              Notiflix.Loading.arrows();
            });
          });
          
          
          function cekRead(){
            let isChecked = $('#cek_read').is(':checked');
            
            $('#nik').prop('readonly', !isChecked);
            $('#alamat').prop('readonly', !isChecked);
            $('#no_hp').prop('readonly', !isChecked);
            $('#email').prop('readonly', !isChecked);
            $('#tempat_lahir').prop('readonly', !isChecked);
            $('#tanggal_lahir').prop('readonly', !isChecked);
          }
          
          
          function cekData(){
            var nama = $('#nama').val();
            var nip = $('#nip').val()
            
            $.ajax({
              url : "/cek-data-pendaftar/" +nama+"/"+nip,
              type: "GET",
              contentType: false,
              processData: false,
              dataType: "JSON",
              success: function(data)
              {
                
                
                console.log(data);
               if (data[1] != null) {

  Notiflix.Report.failure(
    `Akun Anda telah terdaftar.`,
    'Silakan login untuk mulai menggunakan layanan kami',
    'Okay',
  );

} else if (data[0] && data[0].nip != null) {

  $('#nik').val(data[0].nik);
  $('#alamat').text(data[0].alamat);
  $('#no_hp').val(data[0].no_hp);
  $('#email').val(data[0].email);
  $('#tempat_lahir').val(data[0].tempat_lahir);
  $('#tanggal_lahir').val(data[0].tanggal_lahir);

  $('#nik, #alamat, #no_hp, #email, #tempat_lahir, #tanggal_lahir')
    .prop('readonly', false);

  Notiflix.Report.success(
    `Data anda ditemukan`,
    'silahkan lengkapi data pribadi anda yang kosong',
    'Okay',
  );

} else {

  Notiflix.Report.failure(
    `Data anda tidak ditemukan`,
    'silahkan cek kembali NIP dan Nama atau hubungi admin',
    'Okay',
  );

}

                
                
                
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                Notiflix.Report.failure(
                `Gagal`,
                'Data eror atau tidak boleh kosong',
                'Okay',
                )
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
                
              }
            });
            
          }
          
          function previewImage(){
            const image = document.querySelector('.upload_selfie');
            const imagePreview = document.querySelector('.img-preview');
            
            imagePreview.style.display = 'block';
            
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            
            oFReader.onload = function(oFREvent) {
              imagePreview.src = oFREvent.target.result;
            }
          }
          
          
          function previewImage2(){
            const image = document.querySelector('#upload_id_card');
            const imagePreview = document.querySelector('.img-preview2');
            
            imagePreview.style.display = 'block';
            
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            
            oFReader.onload = function(oFREvent) {
              imagePreview.src = oFREvent.target.result;
            }
          }
          
          
          function resetImage() {
            const imageInput = document.querySelector('.upload_selfie');
            const imagePreview = document.querySelector('.img-preview');
            
            // Clear input file
            imageInput.value = '';
            
            // Reset ke default avatar
            imagePreview.src = 'https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg';
          }
          
          function resetImage2() {
            const imageInput = document.querySelector('.upload_id_card');
            const imagePreview = document.querySelector('.img-preview2');
            
            // Clear input file
            imageInput.value = '';
            
            // Reset ke default avatar
            imagePreview.src = 'https://img.pikbest.com/png-images/20241104/id-card-icon-silhouette-white-background_11055062.png!sw800';
          }

          
         function verifyCheck() {
          var myCheck = document.getElementById("myCheck");
          var verify = document.getElementById("verify");

              if (myCheck.checked){
                verify.value = "1";
                $('#close').prop('disabled', false); // untuk men-disable tombol
              }else {
                verify.value = "";
                  $('#close').prop('disabled', true);
              }
       }
          
        </script>
        <script>
          $(document).ready(function(){
            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;
            
            setProgressBar(current);
            
            $(".next").click(function(){
              // Validasi form sebelum lanjut
              var form = $(this).closest('fieldset');
              var inputs = form.find('input[required], textarea[required], select[required]');
              var valid = true;
              
           
              inputs.each(function() {
                if (!$(this).val()) {
                  $(this).addClass('is-invalid');
                  valid = false;
                } else {
                  $(this).removeClass('is-invalid');
                }
              });
              
              if (!valid) {
                Notiflix.Notify.failure('Harap isi semua field yang wajib diisi');
                return false;
              }
              
              current_fs = $(this).parent();
              next_fs = $(this).parent().next();
              
              //Add Class Active
              $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
              
              //show the next fieldset
              next_fs.show();
              //hide the current fieldset with style
              current_fs.animate({opacity: 0}, {
                step: function(now) {
                  opacity = 1 - now;
                  current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                  });
                  next_fs.css({'opacity': opacity});
                },
                duration: 500
              });
              setProgressBar(++current);

                  if (current == 3) {
               $('#modal_form').modal('show');
               $('#close').prop('disabled', true); // untuk men-disable tombol

  
               }
            });
            
            $(".previous").click(function(){
              current_fs = $(this).parent();
              previous_fs = $(this).parent().prev();
             
              //Remove class active
              $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
              
              //show the previous fieldset
              previous_fs.show();
              
              //hide the current fieldset with style
              current_fs.animate({opacity: 0}, {
                step: function(now) {
                  opacity = 1 - now;
                  current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                  });
                  previous_fs.css({'opacity': opacity});
                },
                duration: 500
              });
              setProgressBar(--current);
            });
            
            function setProgressBar(curStep){
              var percent = parseFloat(100 / steps) * curStep;
              percent = percent.toFixed();
              $(".progress-bar")
              .css("width",percent+"%")
            }
          });
        </script>
      </body>
      </html>
      
      
      
      