<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Serikat Kerja Group</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('template/landing')}}/assets/img/favicon.png" rel="icon">
  <link href="{{ asset('template/landing')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/landing')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{ asset('template/landing')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('template/landing')}}/assets/css/main.css" rel="stylesheet">
  <style>

.footer .logo-footer {
      max-width: 75px;
      margin-right: 10px;
    }

    .footer .sitename {
      font-size: 36px;
      font-weight: 700;
    }
    .page-title .heading {
      position: relative;
      /* Pastikan elemen ini menjadi konteks untuk ::after */
      padding: 110px 0;
      border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
      background: url('assets/img/event.jpeg') no-repeat center center;
      background-size: cover;
    }

    .page-title .heading::after {
      content: "";
      /* Harus ada agar pseudo-element muncul */
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      /* Warna overlay gelap */
      z-index: 1;
      /* Pastikan overlay berada di atas background */
    }

    /* Agar teks tetap di atas overlay */
    .page-title .heading h1,
    .page-title .heading p {
      position: relative;
      z-index: 2;
      /* Pastikan teks berada di atas overlay */
    }


    .page-title .heading p {
      color: white;
    }


    /* Gradient Background */
    .bg-gradient-to-br {
      background: linear-gradient(to bottom right, white, #f9fafb);
    }

    .bg-gradient-to-r {
      background: linear-gradient(to right, #2563eb, #3b82f6, #6366f1);
    }

    /* Grid Animation Effect */
    .bg-grid-animation {
      background-image:
        linear-gradient(to right, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
      background-size: 20px 20px;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 0.8;
      }

      50% {
        opacity: 0.5;
      }
    }

    /* Modal Icon Animation */
    .modal-icon {
      transition: transform 0.3s;
    }

    .modal-content:hover .modal-icon {
      transform: scale(1.1);
    }

    /* Custom Button Styles */
    .btn-close-modal {
      background: transparent;
      border: 1px solid #e5e7eb;
      transition: all 0.3s;
    }

    .btn-close-modal:hover {
      background: #f3f4f6;
    }

    .btn-arrow {
      width: 20px;
      height: 20px;
      transition: transform 0.3s;
    }

    .btn-primary-modal:hover .btn-arrow {
      transform: translateX(3px);
    }

    /* Modal Dimensions */
    .h-200px {
      height: 200px;
    }

    .modal-content {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-content:hover {
      transform: translateY(-5px);
      box-shadow: rgba(50, 50, 93, 0.35) 0px 50px 100px -20px,
        rgba(0, 0, 0, 0.4) 0px 30px 60px -30px !important;
    }

    /* Animasi gambar saat hover */
    .card-img-container img {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-content:hover .card-img-container img {
      transform: scale(1.03);
      box-shadow: rgba(149, 157, 165, 0.3) 0px 12px 28px !important;
    }

    /* Animasi halus saat modal muncul */
    .modal.fade .modal-dialog {
      transition: transform 0.3s ease-out, opacity 0.3s ease;
    }
  </style>

</head>

<body class="starter-page-page">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('template/landing')}}/assets/img/logo-srkt.png" alt="">
        <h1 class="sitename">AZ Group</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#team">Event</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="index.html#about">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading" style="background: url('https://img.freepik.com/free-photo/asia-businesswoman-using-laptop-talk-colleagues-about-plan-video-call-meeting-while-working-from-home-living-room-self-isolation-social-distancing-quarantine-corona-virus-prevention_7861-2628.jpg?t=st=1745331448~exp=1745335048~hmac=f8ac56cfa359457d9f14b521441772bfc8bc9707d72ac8c6fd6966ae9db6e2e6&w=1800') no-repeat center center;
  background-size: cover;">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="text-white">Event</h1>
              <p class="mb-0">
                Serikat pekerja hadir sebagai wadah perjuangan untuk melindungi, memperjuangkan, dan meningkatkan
                kesejahteraan seluruh anggotanya. Melalui berbagai kegiatan, kami membangun solidaritas dan memperkuat
                posisi pekerja dalam menghadapi tantangan dunia kerja.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Event</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->


    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>News</h2>
        <p>Our hard working News</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <!-- Dummy 1 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/close-up-people-business-meeting_23-2149304767.jpg?t=st=1745372912~exp=1745376512~hmac=301d5d2d7f1efd3692c5b84d0931566be843c5fbebce265ba65b8365580ff745&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Seminar Kesejahteraan Pekerja</h4>
                  <span>Event</span>
                  <p>Meningkatkan pemahaman anggota terkait hak-hak normatif dan fasilitas jaminan sosial
                    ketenagakerjaan.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 2 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/people-dancing-terrace-party_23-2148231992.jpg?t=st=1745372628~exp=1745376228~hmac=f8fd5c7b8f8ed3179b2eb9c0e2d9d673842f4ea15621edf8829a6fd7ea45b2c0&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Bakti Sosial untuk Pekerja Terdampak PHK</h4>
                  <span>Event</span>
                  <p>Kegiatan pemberian bantuan kepada anggota yang terkena PHK sebagai bentuk solidaritas dan
                    kepedulian bersama.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 3 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/business-team-celebration-christmas-party-concept-office_1150-2875.jpg?t=st=1745372783~exp=1745376383~hmac=1eed2a0e4460f1f28b50339ff1b0dc8088c7295221fafb1a40a03c19e277fdc9&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Pernyataan Sikap Terkait UU Ketenagakerjaan</h4>
                  <span>News</span>
                  <p>Serikat menyuarakan penolakan terhadap pasal-pasal yang merugikan pekerja dalam revisi UU Cipta
                    Kerja terbaru.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 4 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/close-up-people-business-meeting_23-2149304767.jpg?t=st=1745372912~exp=1745376512~hmac=301d5d2d7f1efd3692c5b84d0931566be843c5fbebce265ba65b8365580ff745&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Rapat Koordinasi Tahunan</h4>
                  <span>News</span>
                  <p>Forum strategis untuk mengevaluasi program kerja dan menentukan arah gerak serikat tahun depan.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 5 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/close-up-smiley-women-chatting-company-event_23-2149304732.jpg?t=st=1745765218~exp=1745768818~hmac=d1b881c52be2b5ba90399e42006288407658cabb3e9843c22eea3db741036e95&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Pembekalan Pengurus Baru</h4>
                  <span>Event</span>
                  <p>Kegiatan orientasi dan pelatihan dasar kepemimpinan untuk pengurus baru serikat pekerja.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 6 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/close-up-smiley-woman-chatting-with-colleagues_23-2149304772.jpg?t=st=1745765242~exp=1745768842~hmac=00c30207bc9bc1af4724f8a11d8706cd82f81ecb621325ec0b725292b08b2e53&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Peringatan Hari Keselamatan Kerja</h4>
                  <span>Event</span>
                  <p>Serangkaian kegiatan kampanye pentingnya keselamatan dan kesehatan kerja di lingkungan kerja.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 7 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/close-up-people-chatting-table_23-2149304765.jpg?t=st=1745765274~exp=1745768874~hmac=30dac2f857666e72079c219f7a3208a311fe21f9a77c0b10304764e27a8f9060&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Rilis Statistik Kesejahteraan Anggota</h4>
                  <span>News</span>
                  <p>Data terbaru mengenai pendapatan, tunjangan, dan kondisi kerja anggota serikat dipublikasikan.</p>
                </div>
              </div>
            </a>
          </div>

          <!-- Dummy 8 -->
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <a data-bs-toggle="modal" data-bs-target="#customModal">
              <div class="team-member">
                <div class="member-img">
                  <img
                    src="https://img.freepik.com/free-photo/close-up-people-chatting-event_23-2149304737.jpg?t=st=1745765314~exp=1745768914~hmac=39d7e736d90a680e67715bccdec4c6de182e3756d15bc36e7b7224e2a0a3eaa1&w=2000"
                    class="img-fluid" alt="">
                  <div class="date-vertical p-2">
                    <h5>27</h5>
                    <div class="vertical-text"><span>SEPT</span></div>
                  </div>
                </div>
                <div class="member-info">
                  <h4>Serikat Terima Penghargaan Nasional</h4>
                  <span>News</span>
                  <p>Pengakuan atas dedikasi serikat dalam memperjuangkan kesejahteraan dan perlindungan pekerja.</p>
                </div>
              </div>
            </a>
          </div>


        </div>
      </div>
    </section>



  </main>
  
  <footer id="footer" class="footer pb-0">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Join Our Serikat Kerja</h4>
            <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
            <a class="btn-getstarted p-3 mt-4" href="index.html#about">Daftar Sekarang <i
                class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <img src="{{ asset('template/landing')}}/assets/img/logo-srkt.png" class="logo-footer" alt="">
            <span class="sitename">Pelita Group</span>
          </a>
          <div class="footer-contact pt-3">
            <p class="mb-3">Pelita Group adalah serikat kerja yang berdedikasi untuk melindungi dan memperjuangkan hak-hak
              pekerja di
              berbagai sektor. </p>
            <div class="social-links d-flex">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-3 offset-lg-1 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#team">Event</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-4 offset-lg-1 col-md-12">
          <h4>Follow Us</h4>
          <p class="mb-0">A108 Adam Street <br>New York, NY 535022</p>
          <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>

        </div>
      </div>
    </div>
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1">Pelita Group</strong> <span>All Rights
          Reserved</span></p>
      <div class="credits">
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


  <!-- Modal -->
  <!-- Button Trigger Modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customModal">
    Buka Modal Keren
  </button> -->

  <!-- Modal -->
  <div class="modal fade" id="customModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="margin-top: 50px">
      <div class="modal-content border-0" style="
        background: white;
        border-radius: 12px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, 
                    rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
      ">
        <!-- Floating Image -->
        <div class="card-img-container text-center position-relative" style="
          top: -40px;
          margin: 0 auto;
          width: 90%;
        ">
          <div class="ratio ratio-16x9 rounded overflow-hidden shadow-lg">
            <img
              src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8dGVhbXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=60"
              class="img-fluid object-fit-cover" alt="Workshop Advokasi Hak Pekerja"
              style="transition: transform 0.4s ease;">
          </div>
        </div>

        <!-- Card Content -->
        <div class="modal-body pt-0" style="
          padding: 60px 40px 40px;
          margin-top: -20px;
        ">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="modal-title fw-semibold mb-0">Workshop Advokasi Hak Pekerja</h3>
            <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 fw-medium">
              Event
            </span>
          </div>

          <p class="text-muted mb-2 lh-base">
            Workshop ini diselenggarakan sebagai bagian dari upaya Pelita Group untuk memperkuat kapasitas anggota dalam
            memperjuangkan hak-haknya di lingkungan kerja. Selama dua hari penuh, peserta dibekali dengan materi seputar
            hukum ketenagakerjaan, teknik negosiasi, serta cara menangani kasus-kasus diskriminasi dan ketidakadilan di
            tempat kerja.
            <br>
            Para narasumber berasal dari kalangan profesional hukum, aktivis buruh, dan perwakilan lembaga pemerintah.
            Kegiatan ini juga menjadi ajang diskusi terbuka antaranggota untuk berbagi pengalaman dan membangun jaringan
            solidaritas yang lebih kuat. Harapannya, melalui pelatihan ini, setiap anggota mampu menjadi agen perubahan
            di tempat kerja masing-masing.
          </p>

          <div class="d-grid gap-3 d-md-flex justify-content-md-end">
            <button type="button" class="btn" data-bs-dismiss="modal">
              <i class="bi bi-x-lg me-2"></i>Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>



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

</body>

</html>