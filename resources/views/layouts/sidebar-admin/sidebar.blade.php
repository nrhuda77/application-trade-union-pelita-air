<aside id="layout-menu" class="layout-menu menu-vertical menu "  >
    {{-- #263A5F --}}
    <div class="app-brand demo" >
        <a href="{{ url('halaman_dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo  mt-5">
                <span class="text-primary  ">
                    <img src="{{ asset('assets-admin/img/logo-srkt.png') }}" alt="Logo" height="40" />
                </span>
                
                {{-- <span class="app-brand-text demo menu-text fw-bold m">Admin SPPAS</span> --}}
            </span>
            <span class="app-brand-text demo menu-text fw-bold mt-3">Admin SPPAS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block text-dark"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none text-dark"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-5">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-layout-dashboard"></i>
                <div class="text-dark" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

       

        <!-- Inventory -->
        <li class="menu-header small">
            <span class="menu-header-text text-dark" style="font-weight: bold" data-i18n="Keanggotaan">Keanggotaan</span>
        </li>
   

        
        <li class="menu-item {{ Request::is('pendaftaran-anggota') ? 'active' : '' }}
                             {{ Request::is('detail-pkk*') ? 'active' : '' }}">
            <a href="{{ url('/pendaftaran-anggota') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-device-ipad-check"></i>
                <div class="text-dark">Pendaftaran Anggota</div>
            </a>
        </li>   

		<li class="menu-item {{ Request::is('anggota-serikat') ? 'active' : '' }}">
            <a href="{{ url('/anggota-serikat') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-clipboard-copy"></i>
                <div class="text-dark">Anggota Serikat</div>
            </a>
        </li> 
		
                            


        <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-dark" style="font-weight: bold" data-i18n="Laporan & Pengumuman">Laporan & Pengumuman</span>
        </li>

				
	 <li class="menu-item {{ Request::is('laporan-keluhan') ? 'active' : '' }}
                             {{ Request::is('detail-laporan-keluhan*') ? 'active' : '' }}">
            <a href="{{ url('laporan-keluhan') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-report"></i>
                <div class="text-dark" data-i18n="Laporan Keluhan">Laporan Keluhan</div>
            </a>
        </li>
               

        <li class="menu-item {{ Request::is('event-pengumuman') ? 'active' : '' }}
                             {{ Request::is('detail-event-pengumuman*') ? 'active' : '' }}">
            <a href="{{ url('event-pengumuman') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-calendar-clock"></i>
                <div class="text-dark" data-i18n="Event Pengumuman">Event Pengumuman</div>
            </a>
        </li>
       
        <li class="menu-item {{ Request::is('laporan-keuangan') ? 'active' : '' }}
                             {{ Request::is('detail-laporan-keuangan*') ? 'active' : '' }}">
            <a href="{{ url('laporan-keuangan') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-report-money"></i>
                <div class="text-dark" data-i18n="Laporan Keuangan">Laporan Keuangan</div>
            </a>
        </li>

           


        <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-dark" style="font-weight: bold" data-i18n="Pengaturan dan Lainnya">Pengaturan</span>
        </li>
         <!-- Supplier -->
         
 
         <li  class="menu-item {{Request::is('user-pengguna') ? 'active' : ''}}
                         {{Request::is('detail-user-pengguna*') ? 'active' : ''}}
						 {{Request::is('hak-akses') ? 'active' : ''}}
					     {{Request::is('detail-hak-akses*') ? 'active' : ''}} text-dark">
            <a href="javascript:void(0);" class="menu-link menu-toggle text-dark" style="color: black !important">
                <i class="menu-icon text-dark icon-base ti tabler-user-cog"></i>
                <div class="text-dark" data-i18n="Setting User">Setting User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Request::is('user-pengguna') ? 'active' : ''}}
                                     {{Request::is('detail-user-pengguna*') ? 'active' : ''}}">
                    <a href="/user-pengguna" class="menu-link">
                        <div class="text-dark" data-i18n="User Pengguna">User Pengguna</div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('hak-akses') ? 'active' : ''}}
					                  {{Request::is('detail-hak-akses*') ? 'active' : ''}}">
                    <a href="/hak-akses"  class="menu-link">
                        <div class="text-dark" data-i18n="Hak Akses">Hak Akses</div>
                    </a>
                </li>
            </ul>
        </li>


                <li class="menu-item {{Request::is('page') ? 'active' : ''}}
						 {{Request::is('organization') ? 'active' : ''}}
                         {{Request::is('regulation') ? 'active' : ''}}
                          {{Request::is('about') ? 'active' : ''}} 
                            {{Request::is('contact') ? 'active' : ''}} 
                              {{Request::is('company') ? 'active' : ''}} 
                                {{Request::is('faq') ? 'active' : ''}} 
                          "> 
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon text-dark icon-base ti tabler-device-ipad-horizontal-cog"></i>
                <div class="text-dark" data-i18n="Setting Landing Page">Setting Landing Page</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Request::is('page') ? 'active' : ''}}">
                    <a href="/page" class="menu-link">
                        <div class="text-dark" data-i18n="Page">Page </div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('organization') ? 'active' : ''}} ">
                    <a href="/organization"  class="menu-link">
                        <div class="text-dark" data-i18n="Organization">Organization</div>
                    </a>
                </li>

                 <li class="menu-item {{Request::is('regulation') ? 'active' : ''}}">
                    <a href="/regulation" class="menu-link">
                        <div class="text-dark" data-i18n="Regulation">Regulation </div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('profile') ? 'active' : ''}} ">
                    <a href="/profile"  class="menu-link">
                        <div class="text-dark" data-i18n="About">About</div>
                    </a>
                </li>

                 <li class="menu-item {{Request::is('contact') ? 'active' : ''}}">
                    <a href="/contact" class="menu-link">
                        <div class="text-dark" data-i18n="Contact">Contact </div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('company') ? 'active' : ''}} ">
                    <a href="/company"  class="menu-link">
                        <div class="text-dark" data-i18n="Company">Company</div>
                    </a>
                </li>
                <li class="menu-item  {{Request::is('faq') ? 'active' : ''}} ">
                    <a href="/faq"  class="menu-link">
                        <div class="text-dark" data-i18n="Faqs">Faqs</div>
                    </a>
                </li>
            </ul>
        </li>


            <li class="menu-item {{ Request::is('pkb-admin') ? 'active' : '' }}
                             {{ Request::is('detail-pkb-admin*') ? 'active' : '' }}">
            <a href="{{ url('pkb-admin') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-file-text"></i>
                <div class="text-dark" data-i18n="Dokumen Perjanjian <br> Kerja Bersama (PKB)">Dokumen Perjanjian <br> Kerja Bersama (PKB)</div>
            </a>
        </li>

               <li class="menu-item {{ Request::is('document-pendataan-anggota') ? 'active' : '' }}
                             {{ Request::is('detail-document-pendataan-anggota*') ? 'active' : '' }}">
            <a href="{{ url('document-pendataan-anggota') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-certificate"></i>
                <div class="text-dark" data-i18n="Dokument Pendataan <br> Anggota">Dokument Pendataan <br> Anggota</div>
            </a>
        </li>


	<li class="menu-item">
        
            <a href="{{ url('/logout-admin') }}" class="menu-link"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="menu-icon text-dark icon-base ti tabler-logout"></i>
                <div class="text-dark">Logout</div>
            </a>
             <form id="logout-form" method="POST" action="/logout-admin">
              @csrf
            </form>
        </li> 
	

    </ul>

    	
</aside>



{{-- <script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script> --}}
<script>
//    setInterval(() => {
//   $.ajax({
//           url : "/ajax_numonline" ,
//           type: "GET",
//           dataType: "JSON",
          
//           success: function(data)
//           {
            
//               var element = document.getElementById('number')
//               var element2 = document.getElementById('number2')
//                var element3 = document.getElementById('number3')
//                 var element4 = document.getElementById('number4')
//               element.innerHTML = data[0];
//               element2.innerHTML = data[1];
//               element3.innerHTML = data[2];
//                element4.innerHTML = data[3];

            
//           },
//           error: function (jqXHR, textStatus, errorThrown)
//           {
//               // alert('Error get data from ajax');
//           }
//          });

       
// }, 1000);
</script>


<!-- End Sidebar -->