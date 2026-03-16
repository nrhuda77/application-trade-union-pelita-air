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
            <img src="{{ asset('logo')}}/logo-srkt.png" class="logo-footer" alt="">
            <span class="sitename">SPPELITAAIR</span>
          </a>
          <div class="footer-contact pt-3">
            <p class="mb-3">Serikat Pekerja Pelita Air Service adalah serikat kerja yang berdedikasi untuk melindungi dan memperjuangkan hak-hak
              pekerja di
              berbagai sektor. </p>
            <div class="social-links d-flex">
    @if($contact->facebook ?? false)
        <a href="{{ $contact?->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
    @endif

    @if($contact->instagram ?? false)
        <a href="{{ $contact?->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
    @endif

    @if($contact->linkedin ?? false)
        <a href="{{ $contact?->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
    @endif
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
          <p class="mb-0">{{$company?->address}}</p>
          <p class="mt-3"><a style="color:black" href="https://wa.me?{{$company->phone}}"><strong>Phone:</strong> <span>{{$company->phone}}</span></a></p>
          <p><a style="color:black" href="mailto:{{$company->email}}"><strong>Email:</strong> <span>{{$company->email}}</span></a></p>

        </div>
      </div>
    </div>
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1">Pelita Air Service</strong> <span>All Rights
          Reserved</span></p>
      <div class="credits">
      </div>
    </div>

  </footer>