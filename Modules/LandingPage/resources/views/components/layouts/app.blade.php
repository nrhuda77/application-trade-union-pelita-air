<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Serikat Kerja Group</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo')}}/logo-srkt.png" />
  <!-- Favicons -->

  <link href="{{ asset('template/landing')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="{{ asset('template/landing')}}/https://fonts.googleapis.com" rel="preconnect">
  <link href="{{ asset('template/landing')}}/https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/landing')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('template/admin/assets/vendor/fonts/boxicons.css') }}" />
  <link href="{{ asset('template/landing')}}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('template/landing')}}/assets/css/main.css?v=1.0.001" rel="stylesheet">
    @yield('style')

  <!-- =======================================================
  * Template Name: Pelita Air Service
  * Template URL: https://bootstrapmade.com/Pelita Air Service-bootstrap-startup-template/
  * Updated: Nov 01 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="{{ Request::is('/') ? 'index-page' : 'service-details-page' }}">

  @include('landingpage::components.layouts.navbar')
  
  <main class="main">
    @yield('content')
  </main>

  @include('landingpage::components.layouts.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


  @yield('modal')
  <!-- Vendor JS Files -->
  <script src="{{ asset('template/landing')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/aos/aos.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('template/landing')}}/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="{{ asset('template/landing')}}/assets/js/main.js"></script>

  
  @yield('script')
</body>

</html>