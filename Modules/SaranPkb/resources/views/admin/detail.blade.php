 @extends('layouts.main')

@section('content')
 <div class="col-md">
                  <small class="fw-medium">Detail Pelaporan</small>


                  @php 
                  $no_accordion = 1;
                  @endphp

                  @foreach ($detail_laporan as $dln )
                  
                   <div class="accordion mt-4 accordion-header-primary" id="accordionStyle1">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button
                          type="button"
                          class="accordion-button collapsed"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionStyle1-{{$no_accordion}}"
                          aria-expanded="false">
                          {{ $dln->status }}
                        </button>
                      </h2>

                      <div id="accordionStyle1-{{$no_accordion}}" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1">
                        <div class="accordion-body">
                          
                        <div class="col-lg-12">
                      <div class="card academy-content shadow-none border">
                        <div class="card-body pt-4">
                          <h5  id="judul"></h5>
                          <p class="mb-0" id="jenis_pelaporan"></p>

                             <hr class="my-6">
                            <div class="d-flex flex-wrap row-gap-2">
                            <div class="me-12">
                              <p class=" text-nowrap mb-2" id="anonim"><i class="text-success icon-base ti tabler-spy me-2 align-bottom"></i>Pengirim : {{ $laporan->anonim === 1 ? 'Anonim' : '' }}</p>
                              <p class=" text-nowrap mb-2" id="tenggat"><i class="icon-base text-danger ti tabler-calendar-week me-2 align-bottom"></i> Tenggat :{{ Carbon\Carbon::parse($laporan->tenggat)->format('d F Y') }}</p>
                              <p class=" text-nowrap mb-2" id="stts"><i class="icon-base text-primary ti tabler-notification me-2 align-bottom"></i> Status :</p>
                            </div>
                            </div>

                           <hr class="my-6">
                           <div id="lampiran-container" class="mt-3 mb-3">
                          @php
    $lampiranUrl = $dln->lampiran ?? '';
    $ext = strtolower(pathinfo($lampiranUrl, PATHINFO_EXTENSION));
@endphp

<div id="lampiran-container">

    {{-- GAMBAR --}}
    @if (in_array($ext, ['jpg','jpeg','png','gif','webp']))
        <img src="/{{ $lampiranUrl }}" class="img-fluid w-100 rounded" alt="Lampiran">

    {{-- VIDEO --}}
    @elseif (in_array($ext, ['mp4','webm','ogg']))
        <video class="w-100 rounded" controls>
            <source src="/{{ $lampiranUrl }}" type="video/{{ $ext }}">
            Browser Anda tidak mendukung video.
        </video>

    {{-- PDF & DOCUMENT --}}
    @elseif (in_array($ext, ['pdf','doc','docx','xls','xlsx','ppt','pptx']))
        <iframe src="/{{ $lampiranUrl }}" class="w-100" style="height:600px;" frameborder="0"></iframe>

    {{-- FILE TIDAK DUKUNG --}}
    @else
        <p>File tidak dapat ditampilkan.</p>
    @endif

</div>


                          </div>

                          <hr class="my-6">
                          <h5>Description</h5>
                          <p class="mb-6" id="isi">{{ $dln->isi }}</p>

                           <hr class="my-6">
                          <h5>Tanggapan</h5>
                          <p class="mb-6" id="isi">{{ $dln->tanggapan }}</p>
                        </div>
                      </div>
                   </div>
                        </div>
                      </div>
                    </div>

              
                  </div>

                  @php 
                  $no_accordion++;
                  @endphp

                  @endforeach

                 
                </div>
                
                @endsection