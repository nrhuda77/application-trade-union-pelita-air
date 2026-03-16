@extends('landingpage::components.layouts.app')

@section('style')

  <style>
    .footer .logo-footer {
      max-width: 75px;
      margin-right: 10px;
    }

    .footer .sitename {
      font-size: 36px;
      font-weight: 700;
    }


    .card-regulation {
  background: #fff;
  box-shadow: 0px 0px 14px 0px rgba(192, 192, 192, 0.2);
  transition: all 1s;
}
.nav-link.active {
      /* color: var(--accent-color)!important; */
      background-color: var(--accent-color) !important;
    }


/* Efek hover dan pseudo-elements tetap sama */

.card-regulation::after {
  content: "";
  position: absolute;
  bottom: -30%;
  right: -30%;
  width: 120px;
  height: 120px;
  background: var(--accent-color);
  filter: blur(70px);
  border-radius: 50%;
  transition: width 1s, height 1s;
}

.card-regulation::before {
  content: "";
  position: absolute;
  bottom: -160%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 0;
  height: 0;
  background: var(--accent-color);
  filter: blur(70px);
  border-radius: 50%;
  transition: width 1s, height 1s;
}

.card-regulation:hover::before {
  bottom: -230%;
  width: 1000px;
  height: 1000px;
  filter: blur(1px);
}

.card-regulation:hover {
  background: transparent;
}

.card-regulation:hover .icon {
  background: var(--accent-color) !important;
  transition: all 1s;
}
.card-regulation:hover .icon svg,
.card-regulation:hover .linkMore svg {
  filter: brightness(0) invert(1);
  transition: all 1s;
}

.card-regulation:hover .title,
.card-regulation:hover .subtitle,
.card-regulation:hover .linkMore {
  color: #fff !important;
  transition: all 1s;
}

@media (max-width: 576px) {
  #customModal .modal-content {
    margin-top: 50px;
  }
}



.maps {
  min-height: 400px; /* tinggi minimum */
}

@media (min-width: 992px) {
  .maps {
    min-height: auto;
    height: 100%;
  }
}



  </style>


@endsection
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Serikat Kerja PT. Pelita Air Service
            </h1>
            <p data-aos="fade-up" data-aos-delay="100">Menyatukan Aspirasi & Melindungi Hak Karyawan.</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="/pendaftaran" class="btn-get-started">Daftar Sekarang<i class="bi bi-arrow-right"></i></a>
              <!--<a href="https://www.youtube.com/watch?v=TGuilv0zOHA&ab_channel=Figmin"-->
              <!--  class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i-->
              <!--    class="bi bi-play-circle"></i><span>Watch Video</span></a>-->
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="{{ asset('template/landing')}}/assets/img/testing.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content" style="background: none !important;">
              <h3>Who We Are</h3>
              <h2>Serikat Kerja PT. Pelita Air Service</h2>
              <p>
                Serikat Kerja PT. Pelita Air Service adalah wadah bagi seluruh karyawan Jatra Group untuk menyuarakan aspirasi,
                memperjuangkan hak, serta menjaga keharmonisan hubungan industrial di lingkungan kerja. Berdiri sejak
                tahun 2020, organisasi ini berkomitmen untuk terus mendorong terciptanya kondisi kerja yang adil, aman,
                dan sejahtera.
              </p>
              <div class="text-center text-lg-start">
                <a href="/about"
                  class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('template/landing')}}/assets/img/event.jpeg" class="img-fluid rounded-3" alt="">
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Values Section -->
    <section id="values" class="values section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Values</h2>
        <p>What we value most<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="{{ asset('template/landing')}}/assets/img/radio3.jpg" class="img-fluid" alt="">
              <h3>Kesejahteraan Anggota</h3>
              <p>Kami berkomitmen memperjuangkan hak-hak karyawan, memastikan seluruh anggota mendapatkan kesejahteraan
                yang layak baik secara finansial, keamanan kerja, maupun hak-hak sosial lainnya.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="{{ asset('template/landing')}}/assets/img/radio2.jpg" class="img-fluid" alt="">
              <h3>Transparansi Dan Integritas</h3>
              <p>Setiap keputusan, program, dan kegiatan serikat kerja dilakukan secara terbuka, akuntabel, dan
                berdasarkan prinsip integritas demi kepercayaan seluruh anggota dan perusahaan.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="{{ asset('template/landing')}}/assets/img/radio.jpg" class="img-fluid" alt="">
              <h3>Solidaritas & Kebersamaan</h3>
              <p>Kami percaya bahwa kekuatan terbesar serikat kerja terletak pada persatuan anggotanya. Solidaritas
                menjadi kunci utama dalam menghadapi tantangan dan membangun lingkungan kerja yang adil, nyaman, dan
                harmonis.</p>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="324" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Anggota Aktif</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-4 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-headset color-green flex-shrink-0" style="color: #ff4e41;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="97" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Aspirasi & Pengaduan Diterima</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-4 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-journal-richtext color-orange flex-shrink-0" style="color: #ee6c20;"></i>

              <div>
                <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Kegiatan & Pengumuman Terlaksana</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <!-- <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-people color-pink flex-shrink-0" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>
          </div>End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

     <!-- Alt Features Section -->
<section id="regulation" class="regulation section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Legal Framework & Advocacy</h2>
    <p>Documents Governing Industrial Relations <br> and Compliance</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-5">
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card card-regulation sweeperCard overflow-hidden position-relative border-0 h-100 rounded-4" data-aos="fade-up">
          <div class="card-body p-4 position-relative">
          <div class="d-flex align-items-center">
            <div class="icon d-flex justify-content-center align-items-center mb-3" style="width: 56px; height: 56px; border-radius: 6px; background: color-mix(in srgb, var(--accent-color), transparent 85%);">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none">
                <g stroke="var(--accent-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 8L12 1L21 8V20C21 20.553 20.553 21 20 21H4C3.447 21 3 20.553 3 20V8Z"/>
                  <path d="M9 12H15"/>
                  <path d="M9 16H15"/>
                </g>
              </svg>
              
            </div>
            <h5 class=" ps-3 title fs-4 fw-medium mb-3">Undang-Undang</h5>
          </div>
            <p class="card-text subtitle mb-3" style="line-height: 26px;">
              Kumpulan Undang-Undang Republik Indonesia yang mengatur tentang hubungan industrial dan penyelesaian perselisihan ketenagakerjaan.
            </p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#regulationModal" class="linkMore text-decoration-none justify-content-center d-flex align-items-center gap-2">
              Lihat Daftar
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 12H19" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 5L19 12L12 19" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card card-regulation sweeperCard overflow-hidden position-relative border-0 h-100 rounded-4" data-aos="fade-up">
          <div class="card-body p-4 position-relative">
          <div class="d-flex align-items-center">
            <div class="icon d-flex justify-content-center align-items-center mb-3" style="width: 56px; height: 56px; border-radius: 6px; background: color-mix(in srgb, var(--accent-color), transparent 85%);">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none">
                <g stroke="var(--accent-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 8L12 1L21 8V20C21 20.553 20.553 21 20 21H4C3.447 21 3 20.553 3 20V8Z"/>
                  <path d="M9 12H15"/>
                  <path d="M9 16H15"/>
                </g>
              </svg>
            </div>
            <h5 class=" ps-3 title fs-4 fw-medium mb-3">Peraturan Pemerintah</h5>
          </div>
            <p class="card-text subtitle mb-3" style="line-height: 26px;">
              Peraturan pelaksana dari Undang-Undang yang dikeluarkan oleh Pemerintah untuk mengatur teknis penyelenggaraan ketenagakerjaan.
            </p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#regulationModal" class="linkMore text-decoration-none justify-content-center d-flex align-items-center gap-2">
              Lihat Daftar
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 12H19" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 5L19 12L12 19" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="card card-regulation sweeperCard overflow-hidden position-relative border-0 h-100 rounded-4" data-aos="fade-up">
          <div class="card-body p-4 position-relative">
          <div class="d-flex align-items-center">
            <div class="icon d-flex justify-content-center align-items-center mb-3" style="width: 56px; height: 56px; border-radius: 6px; background: color-mix(in srgb, var(--accent-color), transparent 85%);">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none">
                <g stroke="var(--accent-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 8L12 1L21 8V20C21 20.553 20.553 21 20 21H4C3.447 21 3 20.553 3 20V8Z"/>
                  <path d="M9 12H15"/>
                  <path d="M9 16H15"/>
                </g>
              </svg>
            </div>
            <h5 class=" ps-3 title fs-4 fw-medium mb-3">Peraturan Menteri</h5>
          </div>
            <p class="card-text subtitle mb-3" style="line-height: 26px;">
              Peraturan teknis yang dikeluarkan oleh Menteri Ketenagakerjaan sebagai pedoman implementasi di bidang ketenagakerjaan.
            </p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#regulationModal" class="linkMore text-decoration-none justify-content-center d-flex align-items-center gap-2">
              Lihat Daftar
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 12H19" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 5L19 12L12 19" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Alt Features Section -->

    <!-- Alt Features Section -->
    <section id="alt-features" class="alt-features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Features</h2>
        <p>Our Advanced Features<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">

            <div class="row align-self-center gy-5">

              <div class="col-md-6 icon-box">
                <i class="bi bi-phone"></i>
                <div>
                  <h4>Pendaftaran Anggota Online</h4>
                  <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-card-checklist"></i>
                <div>
                  <h4>Penyampaian Aspirasi Mudah</h4>
                  <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-lightning-charge"></i>

                <div>
                  <h4>Notifikasi Pengumuman Real-Time</h4>
                  <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-dribbble"></i>

                <div>
                  <h4>Event & Kegiatan Terjadwal</h4>
                  <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-filter-circle"></i>

                <div>
                  <h4>Data Anggota Aman & Terpusat</h4>
                  <p>Et fuga et deserunt et enim. Dolorem architecto ratione tensa raptor marte</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-patch-check"></i>
                <div>
                  <h4>Dukungan Hukum & Advokasi</h4>
                  <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
                </div>
              </div><!-- End Feature Item -->

            </div>

          </div>

          <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('template/landing')}}/assets/img/alt-features.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>

    </section><!-- /Alt Features Section -->

    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Organizations</h2>
        <p>Our Network of Organizations</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          @foreach ($organizations as $index => $item)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item {{ ['item-indigo', 'item-cyan', 'item-pink'][$index % 3] }} position-relative">
              {{-- <i class="bi bi-bounding-box-circles icon"></i> --}}
              <i class="bi bi-columns-gap icon"></i>
              <h3>{{ $item->unit_name }}</h3>
        
              <!-- Limit description to 20 words and remove HTML tags -->
              <p>{{ \Str::words(strip_tags($item->description), 20,'...') }}</p>
        
              <a href="/unit" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        @endforeach
        <div class="d-flex justify-content-center mt-2">
          <a class="btn-getstarted m-0" href="/unit">See All</a>
        </div>
        </div>

      </div>

    </section><!-- /Services Section -->
    
    <!-- Event Section -->
    <section id="event" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Event</h2>
        <p>Our hard working Event</p>
      </div><!-- End Section Title -->

      <div class="container">
        <!-- Swiper -->
        <div class="swiper team-swiper">
          <div class="swiper-wrapper mb-5 pb-4">
            
            @foreach ($events as $index => $item)
              <!-- Slide 1 -->
              <div class="swiper-slide d-flex align-items-stretch h-auto" data-aos="fade-up" data-aos-delay="100">
                <a href="javascript:void(0);" class="event-card" data-index="{{ $index }}" data-title="{{ $item->judul }}" data-description="{{ $item->isi }}" data-image="{{ asset($item->lampiran ?? 'gallery/default_photo.jpg') }}">
                  <div class="team-member">
                    <div class="member-img">
                      <img src="{{ asset($item->lampiran ?? 'gallery/default_photo.jpg') }}" class="img-fluid" alt="">
                      <div class="date-vertical p-2">
                        <h5>{{ \Carbon\Carbon::parse($item->waktu_event)->format('d') }}</h5>
                        <div class="vertical-text">
                          <span>{{ \Carbon\Carbon::parse($item->waktu_event)->format('M') }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="member-info">
                      <h4>{{ $item->judul }}</h4>

                      <!-- Menambahkan Kategori dengan Warna yang Dinamis -->
                      @php
                        $badgeClass = '';
                        switch ($item->kategori) {
                          case 'Event':
                            $badgeClass = 'bg-primary';
                            break;
                          case 'Info':
                            $badgeClass = 'bg-info';
                            break;
                          case 'Berita':
                            $badgeClass = 'bg-warning';
                            break;
                          case 'Pendidikan':
                            $badgeClass = 'bg-success';
                            break;
                          case 'Leadership':
                            $badgeClass = 'bg-light';
                            break;
                          case 'Iuran':
                            $badgeClass = 'bg-dark';
                            break;
                          default:
                            $badgeClass = 'bg-secondary'; // Default color
                            break;
                        }
                      @endphp
                      <span class="d-inline-block badge bg-opacity-10 py-2 px-3 {{ $badgeClass }}">{{ $item->kategori }}</span>
                      
                      <p>{{ \Str::words($item->isi, 22,'...') }}</p>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach


          
          </div>
          <div class="swiper-pagination pt-5"></div>

        </div>
        <div class="d-flex justify-content-center mt-2">
          <a class="btn-getstarted m-0" href="/event">See All</a>
        </div>
      </div>
    </section><!-- /Event Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>F.A.Q</h2>
        <p>Frequently Asked Questions</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row">
          <div class="col-xl-6 d-flex align-items-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('template/landing')}}/assets/img/radio1.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-container">
              @foreach ($faq as $index => $item)
              <div class="faq-item {{ $index == 0 ? 'faq-active' : '' }}">
                <h3>{{$item->title}}</h3>
                <div class="faq-content">
                  <p>{{$item->description}}</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              @endforeach
            </div>
          </div><!-- End Faq Column-->
        </div>
      </div>
    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact faq section">

      <!-- Section Title -->
      <section id="contact" class="contact faq section">
      <!-- Section Title -->
      <div class="container section-title pb-3" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->
    
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <!-- Navigation untuk memilih lokasi (tombol) menggunakan nav-pills -->
        <div class="d-flex justify-content-center mb-4">
          <ul class="nav nav-pills" id="locationTabs" role="tablist" style="display: flex; justify-content: center;">
            @foreach($contacts as $contact)
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                        id="location-{{ $contact->id }}-btn" 
                        data-bs-toggle="pill" 
                        data-bs-target="#location-{{ $contact->id }}" 
                        type="button" 
                        role="tab" 
                        aria-controls="location-{{ $contact->id }}" 
                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                  {{ $contact->city }}
                </button>
              </li>
            @endforeach
          </ul>
        </div>
    
        <!-- Tab content -->
        <div class="tab-content" id="locationTabsContent">
          @foreach($contacts as $contact)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                 id="location-{{ $contact->id }}" 
                 role="tabpanel" 
                 aria-labelledby="location-{{ $contact->id }}-btn">
              <div class="row gy-4 d-flex flex-column flex-lg-row">
                <div class="col-lg-6">
                  <div class="row gy-4">
                    
                    <div class="col-md-6">
                      <div class="info-item" data-aos="fade" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Address</h3>
                        <p>{{ $contact->address }}</p>
                      </div>
                    </div>
    
                    <div class="col-md-6">
                      <div class="info-item" data-aos="fade" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Call Us</h3>
                        <p>{{ $contact->no_hp }}</p>
                      </div>
                    </div>
    
                    <div class="col-md-6">
                      <div class="info-item" data-aos="fade" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email Us</h3>
                        <p>{{ $contact->email }}</p>
                      </div>
                    </div>
    
                    <div class="col-md-6">
                      <div class="info-item" data-aos="fade" data-aos-delay="500">
                        <i class="bi bi-clock"></i>
                        <h3>Open Hours</h3>
                        <p>{{ $contact->open_hours }}</p>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="col-lg-6">
                  <div class="maps rounded-4 h-100">
                    {!! $contact->gmaps !!}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section><!-- /Contact Section -->



  @endsection
  @section('modal')


  <!-- Modal -->
<div class="modal fade" id="customModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="margin-top: 50px">
    <div class="modal-content border-0" style="background: white; border-radius: 12px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;">
      
      <!-- Floating Image -->
      <div class="card-img-container text-center position-relative" style="top: -40px; margin: 0 auto; width: 90%;">
        <div class="ratio ratio-16x9 rounded overflow-hidden shadow-lg">
          <img id="modalImage" class="img-fluid object-fit-cover" alt="Event Image" style="transition: transform 0.4s ease;">
        </div>
      </div>

      <!-- Card Content -->
      <div class="modal-body pt-0" style="padding: 60px 40px 40px; margin-top: -20px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 id="modalTitle" class="modal-title fw-semibold mb-0">Event Title</h3>
          <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 fw-medium">Event</span>
        </div>

        <p id="modalDescription" class="text-muted mb-2 lh-base">
          Event description goes here.
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



  <div class="modal fade" id="regulationModal" tabindex="-1" aria-labelledby="regulationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white border-0">
                <h3 class="modal-title fw-bold"><i class="bi bi-journal-bookmark me-2"></i> Dokumen Hukum</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-tabs-primary px-4 pt-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="uu-tab" data-bs-toggle="tab" data-bs-target="#uu" type="button" role="tab">Undang-Undang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pp-tab" data-bs-toggle="tab" data-bs-target="#pp" type="button" role="tab">Peraturan Pemerintah</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pm-tab" data-bs-toggle="tab" data-bs-target="#pm" type="button" role="tab">Peraturan Menteri</button>
                    </li>
                </ul>

                <div class="tab-content p-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="uu" role="tabpanel">
                        <div class="accordion" id="accordionUU">
                            @foreach ($regulations['undang-undang'] as $regulation)
                            <div class="accordion-item border-0 mb-2 shadow-sm">
                                <h2 class="accordion-header" id="heading{{ $regulation->id }}">
                                    <button class="accordion-button bg-white text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $regulation->id }}">
                                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                                        <span class="fw-bold">{{ $regulation->title }}</span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $regulation->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionUU">
                                    <div class="accordion-body pt-0">
                                        <p class="text-muted">{{ $regulation->description }}</p>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#previewModal" data-file="{{ asset('gallery/'.$regulation->file) }}">
                                                <i class="bi bi-eye me-1"></i> Preview
                                            </button>
                                            <a href="{{ asset('gallery/'.$regulation->file) }}" class="btn btn-sm btn-primary" download>
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pp" role="tabpanel">
                        <div class="accordion" id="accordionPP">
                            @foreach ($regulations['pemerintah'] as $regulation)
                            <div class="accordion-item border-0 mb-2 shadow-sm">
                                <h2 class="accordion-header" id="heading{{ $regulation->id }}">
                                    <button class="accordion-button bg-white text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $regulation->id }}">
                                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                                        <span class="fw-bold">{{ $regulation->title }}</span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $regulation->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionPP">
                                    <div class="accordion-body pt-0">
                                        <p class="text-muted">{{ $regulation->description }}</p>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#previewModal" data-file="{{ asset('gallery/'.$regulation->file) }}">
                                                <i class="bi bi-eye me-1"></i> Preview
                                            </button>
                                            <a href="{{ asset('gallery/'.$regulation->file) }}" class="btn btn-sm btn-primary" download>
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pm" role="tabpanel">
                        <div class="accordion" id="accordionPM">
                            @foreach ($regulations['menteri'] as $regulation)
                            <div class="accordion-item border-0 mb-2 shadow-sm">
                                <h2 class="accordion-header" id="heading{{ $regulation->id }}">
                                    <button class="accordion-button bg-white text-dark shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $regulation->id }}">
                                        <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                                        <span class="fw-bold">{{ $regulation->title }}</span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $regulation->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionPM">
                                    <div class="accordion-body pt-0">
                                        <p class="text-muted">{{ $regulation->description }}</p>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#previewModal" data-file="{{ asset('gallery/'.$regulation->file) }}">
                                                <i class="bi bi-eye me-1"></i> Preview
                                            </button>
                                            <a href="{{ asset('gallery/'.$regulation->file) }}" class="btn btn-sm btn-primary" download>
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="previewModalLabel">Preview Dokumen</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <iframe id="previewFrame" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
          </div>
      </div>
  </div>
</div>


  @endsection
  @section('script')
  <script>
    var teamSwiper = new Swiper('.team-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2
        },
        992: {
          slidesPerView: 3
        },
        1200: {
          slidesPerView: 4
        }
      }
    });

    // Ambil semua elemen dengan kelas "event-card"
    const eventCards = document.querySelectorAll('.event-card');

    eventCards.forEach(card => {
      card.addEventListener('click', function() {
        // Ambil data dari atribut data- yang ada di elemen yang diklik
        const title = card.getAttribute('data-title');
        const description = card.getAttribute('data-description');
        const image = card.getAttribute('data-image');

        // Update konten modal dengan data yang dipilih
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDescription').innerText = description;
        document.getElementById('modalImage').src = image;

        // Tampilkan modal
        const myModal = new bootstrap.Modal(document.getElementById('customModal'));
        myModal.show();
      });
    });

  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const previewButtons = document.querySelectorAll('[data-bs-target="#previewModal"]');
        const previewFrame = document.getElementById('previewFrame');

        previewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const file = this.getAttribute('data-file');
                previewFrame.src = file; // Set src iframe ke file dokumen
            });
        });
    });
</script>
@endsection
@section('script')