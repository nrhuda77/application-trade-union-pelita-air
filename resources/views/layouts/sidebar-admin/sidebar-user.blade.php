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
        <li class="menu-item {{ Request::is('dashboard-user') ? 'active' : '' }}">
            <a href="{{ url('/dashboard-user') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-layout-dashboard"></i>
                <div class="text-dark" data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

       

             


        <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-dark" style="font-weight: bold" data-i18n="Laporan & Pengumuman">Laporan & Pengumuman</span>
        </li>

				
	 <li class="menu-item {{ Request::is('laporan-keluhan-anggota') ? 'active' : '' }}
                             {{ Request::is('detail-laporan-keluhan-anggota*') ? 'active' : '' }}">
            <a href="{{ url('laporan-keluhan-anggota') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-report"></i>
                <div class="text-dark" data-i18n="Laporan Keluhan">Laporan Keluhan</div>
            </a>
        </li>
               

       
        <li class="menu-item {{ Request::is('laporan-keuangan-serikat') ? 'active' : '' }}
                             {{ Request::is('detail-*laporan-keuangan-serikat') ? 'active' : '' }}">
            <a href="{{ url('/laporan-keuangan-serikat') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-report-money"></i>
                <div class="text-dark" data-i18n="Laporan Keuangan">Laporan Keuangan</div>
            </a>
        </li>

           

 
      

  <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text text-dark" style="font-weight: bold" data-i18n="Dokumen">Dokumen</span>
        </li>
              


            <li class="menu-item {{ Request::is('pdf-pkb') ? 'active' : '' }}
                             {{ Request::is('detail-pdf-pkb*') ? 'active' : '' }}">
            <a href="{{ url('pdf-pkb') }}" class="menu-link">
                <i class="menu-icon text-dark icon-base ti tabler-file-text"></i>
                <div class="text-dark" data-i18n="Dokumen Perjanjian <br> Kerja Bersama (PKB)">Dokumen Perjanjian <br> Kerja Bersama (PKB)</div>
            </a>
        </li>


	<li class="menu-item">
        
            <a href="{{ url('/logout') }}" class="menu-link"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="menu-icon text-dark icon-base ti tabler-logout"></i>
                <div class="text-dark">Logout</div>
            </a>
             <form id="logout-form" method="POST" action="/logout">
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