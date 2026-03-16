
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

    <title>Reset Password</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo')}}/logo-srkt.png" />

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
    <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('template/admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('template/admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('template/admin/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->


        <!-- Menu -->

        <!-- / Menu -->


            <div class="container-xxl">
                <div class="authentication-wrapper authentication-basic container-p-y">
                  <div class="authentication-inner">
                    <!-- Register Card -->
                    <div class="card">
                      <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                          <a href="{{ url('/')}}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                         <img src="{{ asset('logo')}}/logo-srkt.png" alt="" width="70">
                        </span>
                          </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Permintaan Atur Ulang Password</h4>
                        <p class="mb-4">Kami menerima permintaan untuk mereset password Anda.</p>
          
                        <form id="formRePassword" class="mb-3" action="/update-password" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
                          <input type="hidden" name="email" value="{{ $email }}">
                          
                          <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Masukkan Password Baru</label>
                            <div class="input-group input-group-merge">
                              <input type="password" id="password" class="form-control" name="password" placeholder="Buat Password" aria-describedby="password"/>
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                          </div>
          
                          <button type="submit" class="btn btn-primary d-grid w-100">Registrasi Password</button>
                        </form>
          
                      
                      </div>
                    </div>
                    <!-- Register Card -->
                  </div>
                </div>
              </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        


      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('template/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('template/admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('template/admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('template/admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('template/admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('template/admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('template/admin/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js') }}"></script>
  </body>
</html>



