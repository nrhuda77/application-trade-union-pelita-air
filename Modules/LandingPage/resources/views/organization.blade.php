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


    .timeline {
        position: relative;
        padding-left: 1rem;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 2.5rem;
        width: 2px;
        background: #dee2e6;
    }
    
    .timeline-item {
        position: relative;
    }
    
    .timeline-date {
        position: relative;
        z-index: 1;
        font-weight: 500;
    }
    
    @media (min-width: 768px) {
        .timeline::before {
            left: calc(16.666667% + 0.5rem);
        }
    }

    .tiny-text p{
      margin-bottom:0.5rem; 
    }
    .tiny-text ul {
      padding-left: 1.5rem;
      list-style-type: initial !important;
    }

    .tiny-text ol {
      padding-left: 1.5rem;
      list-style-type: decimal !important;
    }

    .tiny-text li {
      margin-bottom: 0.5rem;
    }   
    .tiny-text li {
  display: list-item !important;
}
  </style>
@endsection

@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading" style="background: url('https://img.freepik.com/free-photo/asia-businesswoman-using-laptop-talk-colleagues-units-plan-video-call-meeting-while-working-from-home-living-room-self-isolation-social-distancing-quarantine-corona-virus-prevention_7861-2628.jpg?t=st=1745331448~exp=1745335048~hmac=f8ac56cfa359457d9f14b521441772bfc8bc9707d72ac8c6fd6966ae9db6e2e6&w=1800') no-repeat center center;
  background-size: cover;">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="text-white">Units</h1>
              <p class="mb-0">Serikat Pekerja PT. Pelita Air Service (SPPAS) - Organisasi yang dibentuk dari, oleh, dan untuk pekerja yang bersifat bebas, terbuka, mandiri, demokratis, dan bertanggung jawab.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Units</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

            <div class="service-box">
              <h4>Units</h4>
              <div class="services-list nav flex-column" id="serviceTab" role="tablist">
                <!-- Tab About -->
                @foreach ($units as $index => $item)  
                <a href="#" class="nav-link {{ $index == 0 ? 'active' : '' }}" id="{{$item->slug}}-tab" data-bs-toggle="tab" data-bs-target="#{{$item->slug}}"
                role="tab">
                  <i class="bi bi-arrow-right-circle"></i><span>{{$item->unit_name}}</span>
                </a>
                @endforeach
              </div>
            </div>
            
            <div class="help-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-headset help-icon"></i>
              <h4>Punya Pertanyaan?</h4>
              <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>+62 21 12345678</span></p>
              <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <a
                  href="mailto:info@sppas.com">info@sppas.com</a></p>
            </div>

          </div>

          <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">

            <div class="tab-content" id="serviceTabContent">
              @foreach ($units as $index => $item)
                  
              <div class="tab-pane fade show {{ $index == 0 ? 'active' : '' }}" id="{{$item->slug}}" role="tabpanel">
                <img src="{{ asset('gallery/'.$item->banner)}}" alt="Serikat Pekerja" class="img-fluid services-img">
                <h3>{!!$item->unit_name!!}</h3>
                <div class="tiny-text">
                  {!! $item->description !!}
                </div>
                <img src="{{ asset('gallery/'.$item->structure_image)}}" alt="Serikat Pekerja" class="img-fluid services-img">
              </div>
              @endforeach

             
              
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Service Details Section -->
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="docModal" tabindex="-1" aria-labelledby="docModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 90vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="docModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="height: 80vh;">
        <iframe src="" frameborder="0" style="width:100%; height:100%;"></iframe>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')  
<script>
  document.querySelectorAll('.open-doc').forEach(el => {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      const docUrl = this.getAttribute('data-doc');
      const title = this.getAttribute('data-title');

      const modal = new bootstrap.Modal(document.getElementById('docModal'));
      document.getElementById('docModalLabel').textContent = title;
      document.querySelector('#docModal iframe').src = docUrl;
      modal.show();

      // Clear iframe src when modal hidden to stop loading document
      document.getElementById('docModal').addEventListener('hidden.bs.modal', () => {
        document.querySelector('#docModal iframe').src = '';
      }, { once: true });
    });
  });
</script>
@endsection
  