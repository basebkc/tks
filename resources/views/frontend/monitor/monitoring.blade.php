
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
		
		<title>Monitoring WhatApps</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Call App Mode on ios devices -->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		 <!-- Remove Tap Highlight on Windows Phone IE -->
		<meta name="msapplication-tap-highlight" content="no">
		<!-- base css -->
		
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/vendors.bundle.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/app.bundle.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/themes/cust-theme-8.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/toastr/toastr.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/fa-solid.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
				
        @livewireStyles
		@yield('head')
	<!-- Place favicon.ico in the root directory -->
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="mask-icon" href="{{ asset('assets/bs4/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <style>
        .swal2-container {
           z-index: 10050;
        }
    </style>
        <!-- Scripts -->
     <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="mod-bg-1 ">
	<script>
		/**
		 *	This script should be placed right after the body tag for fast execution
		 *	Note: the script is written in pure javascript and does not depend on thirdparty library
		 **/
		'use strict';

		var classHolder = document.getElementsByTagName("BODY")[0],
			/**
			 * Load from localstorage
			 **/
			themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
				{},
			themeURL = themeSettings.themeURL || '',
			themeOptions = themeSettings.themeOptions || '';
		/**
		 * Load theme options
		 **/
		if (themeSettings.themeOptions)
		{
			classHolder.className = themeSettings.themeOptions;
			console.log("%c✔ Theme settings loaded", "color: #148f32");
		}
		else
		{
			console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
		}
		if (themeSettings.themeURL && !document.getElementById('mytheme'))
		{
			var cssfile = document.createElement('link');
			cssfile.id = 'mytheme';
			cssfile.rel = 'stylesheet';
			cssfile.href = themeURL;
			document.getElementsByTagName('head')[0].appendChild(cssfile);
		}
		/**
		 * Save to localstorage
		 **/
		var saveSettings = function()
		{
			themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
			{
				return /^(nav|header|mod|display)-/i.test(item);
			}).join(' ');
			if (document.getElementById('mytheme'))
			{
				themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
			};
			localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
		}
		/**
		 * Reset settings
		 **/
		var resetSettings = function()
		{
			localStorage.setItem("themeSettings", "");
		}
	</script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner" style="margin-left: 0.20px;">
                        <!-- we need this logo when user switches to nav-function-top -->
                            <div class="page-logo">
                                <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                    
                                    <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                    <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                                </a>
                            </div>
                        <!-- DOC: nav menu layout change shortcut -->
                    
                        <!-- DOC: mobile button appears during mobile width -->
                        
                       
                        <div class="ml-auto d-flex">
                            <!-- activate app search icon (mobile) -->
                            <div class="hidden-sm-up">
                                <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                                    <i class="fal fa-search"></i>
                                </a>
                            </div>
                            <!-- app settings -->
                            <div class="hidden-md-down">
                                <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                                    <i class="fal fa-cog"></i>
                                </a>
                            </div>
                            <!-- app shortcuts -->
                            	<!-- DOC: nav menu layout change shortcut -->
					
                            <div class="ml-auto d-flex">
                                <!-- app user menu -->
                                <div>
                                    <a href="#" data-toggle="dropdown" title=""
                                    class="header-icon d-flex align-items-center justify-content-center ml-2">
                                        <img src="{{ asset('assets/img/favicon.png') }}" class="profile-image rounded-circle"
                                            alt="logout" style="object-position: top;
                                                object-fit: cover;
                                                height: 50px;
                                                width: 50px;"> 
                                        {{-- you can also add username next to the avatar with the codes below: --}}
                                        	
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                        <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                            <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                                    <span class="mr-2">
                                                        <img src="{{ asset('assets/img/favicon.png') }}"
                                                            class="rounded-circle profile-image" alt="userPhoto" style="
                                                            object-fit: cover;
                                                            object-position: top;
                                                        ">
                                                    </span>
                                                <div class="info-card-text">
                                                    <div class="fs-lg text-truncate text-truncate-lg"></div>
                                                    <span
                                                        class="text-truncate text-truncate-md opacity-80"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                            <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                            <i class="float-right text-muted fw-n">F11</i>
                                        </a>
                                        <a href="{{env('APP_URL_HOME')}}" class="dropdown-item" >
                                            <span data-i18n="drpdwn.fullscreen">Bank BKC</span>
                                            <i class="float-right text-muted fw-n">Back to Home</i>
                                        </a>
                                        <a href="{{ url('login') }}" class="dropdown-item" >
                                            <span data-i18n="drpdwn.fullscreen">Log In</span>
                                            
                                        </a>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                          
                            <!-- app message -->
                            <!-- app notification -->
                            <!-- app user menu -->
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-header">
                                            Dashboard
                                        </div>

                                        <div class="card-body">
                                            @if(session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Last 30 speed measurements</h3>
                                                    <canvas id="myChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="frame-heading mt-3 ">
                                        Displaying all key events
                                    </div>
                                    <div id="app-eventlog" class="alert alert-primary h-auto my-3"></div>
                                    <a href="#" class="btn btn-sm btn-outline-danger" onclick="clearlogText(); return false;">
                                        Clear Log
                                    </a>
                                </div>
                            </div>
                        </div>
                    </main>

 <!-- this overlay is activated only when mobile menu is triggered -->
 <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
 <!-- BEGIN Page Footer -->
 <footer class="page-footer" role="contentinfo">
     <strong>Copyright &copy; {{ config('app.copy_right_year','2021') }} <a href="{{ config('app.copy_right_web','') }}">{{ config('app.copy_right_name','') }}</a>.</strong>
     Team IT &nbsp;
     <div class="float-right d-none d-sm-inline-block">
     <b>Version</b> {{ config('app.version','1.0') }}
     </div>
 </footer>
 <!-- END Page Footer -->
 <!-- BEGIN Shortcuts -->
 <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
     <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
         <div class="modal-content">
             <div class="modal-body">
                 <ul class="app-list w-auto h-auto p-0 text-left">
                     <li>
                         <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                             <div class="icon-stack">
                                 <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                 <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                 <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                             </div>
                             <span class="app-list-name">
                                 Home
                             </span>
                         </a>
                     </li>
                     <li>
                         <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                             <div class="icon-stack">
                                 <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                 <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                 <i class="ni ni-envelope icon-stack-1x text-white"></i>
                             </div>
                             <span class="app-list-name">
                                 Inbox
                             </span>
                         </a>
                     </li>
                     <li>
                         <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                             <div class="icon-stack">
                                 <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                 <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                             </div>
                             <span class="app-list-name">
                                 Add More
                             </span>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <!-- END Shortcuts -->
 <!-- BEGIN Color profile -->
 <!-- this area is hidden and will not be seen on screens or screen readers -->
 <!-- we use this only for CSS color refernce for JS stuff -->
 <p id="js-color-profile" class="d-none">
     <span class="color-primary-50"></span>
     <span class="color-primary-100"></span>
     <span class="color-primary-200"></span>
     <span class="color-primary-300"></span>
     <span class="color-primary-400"></span>
     <span class="color-primary-500"></span>
     <span class="color-primary-600"></span>
     <span class="color-primary-700"></span>
     <span class="color-primary-800"></span>
     <span class="color-primary-900"></span>
     <span class="color-info-50"></span>
     <span class="color-info-100"></span>
     <span class="color-info-200"></span>
     <span class="color-info-300"></span>
     <span class="color-info-400"></span>
     <span class="color-info-500"></span>
     <span class="color-info-600"></span>
     <span class="color-info-700"></span>
     <span class="color-info-800"></span>
     <span class="color-info-900"></span>
     <span class="color-danger-50"></span>
     <span class="color-danger-100"></span>
     <span class="color-danger-200"></span>
     <span class="color-danger-300"></span>
     <span class="color-danger-400"></span>
     <span class="color-danger-500"></span>
     <span class="color-danger-600"></span>
     <span class="color-danger-700"></span>
     <span class="color-danger-800"></span>
     <span class="color-danger-900"></span>
     <span class="color-warning-50"></span>
     <span class="color-warning-100"></span>
     <span class="color-warning-200"></span>
     <span class="color-warning-300"></span>
     <span class="color-warning-400"></span>
     <span class="color-warning-500"></span>
     <span class="color-warning-600"></span>
     <span class="color-warning-700"></span>
     <span class="color-warning-800"></span>
     <span class="color-warning-900"></span>
     <span class="color-success-50"></span>
     <span class="color-success-100"></span>
     <span class="color-success-200"></span>
     <span class="color-success-300"></span>
     <span class="color-success-400"></span>
     <span class="color-success-500"></span>
     <span class="color-success-600"></span>
     <span class="color-success-700"></span>
     <span class="color-success-800"></span>
     <span class="color-success-900"></span>
     <span class="color-fusion-50"></span>
     <span class="color-fusion-100"></span>
     <span class="color-fusion-200"></span>
     <span class="color-fusion-300"></span>
     <span class="color-fusion-400"></span>
     <span class="color-fusion-500"></span>
     <span class="color-fusion-600"></span>
     <span class="color-fusion-700"></span>
     <span class="color-fusion-800"></span>
     <span class="color-fusion-900"></span>
 </p>
 <!-- END Color profile -->
</div>
</div>
</div>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
<nav class="shortcut-menu d-none d-sm-block">
<input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
<label for="menu_open" class="menu-open-button ">
<span class="app-shortcut-icon d-block"></span>
</label>
<a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
<i class="fal fa-arrow-up"></i>
</a>
<a href="page_login_alt.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
<i class="fal fa-sign-out"></i>
</a>
<a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
<i class="fal fa-expand"></i>
</a>
<a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
<i class="fal fa-print"></i>
</a>
<a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left" title="Voice command">
<i class="fal fa-microphone"></i>
</a>
</nav>
<script src="{{ asset('assets/js/vendors.bundle.js') }}"></script>
<script src="{{ asset('assets/js/app.bundle.js') }}"></script>
<script src="{{asset('assets/js/datagrid/datatables/jquery.dataTables.min.js') }}"></script>
@yield('scripts')
<script>
initApp.pushSettings("layout-composed", false);

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
  var ctx = document.getElementById("myChart");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Speed',
        data: [ 20 ],
        borderWidth: 1,
        borderColor: 'rgb(75, 192, 192)',
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });

//   var current = new Date();
//   var dt = new Date();
//   var dateto =  dt.getFullYear()+'-'+ dt.getMonth() +'-'+dt.getDate() +" "+ dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
//   var datefrom =  dt.getFullYear()+'-'+ dt.getMonth() +'-'+dt.getDate() +" "+ dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

    var updateChart = function() {

        $.ajax({
            url: "{{ route('frontend.getnotif') }}",
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

                console.log(data);
                // console.log(myChart);

                myChart.data.labels =  data.labels;
                myChart.data.datasets[0].data = data.data;
                // myChart.update();
            },
            error: function(data){
                console.log(data);
            }
        });
    }


    var events = $('#app-eventlog');
    var clearlogText = function()
    {
        events.empty();
    }

    // $(document).ready(function()
    // {
        var getLogNotif = function() {

            $.ajax({
                url: "{{ route('frontend.getlognotif') }}",
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    events.prepend(data);
                    // console.log(data);
                    // console.log(myChart);

                    // myChart.data.labels =  data.labels;
                    // myChart.data.datasets[0].data = data.data;
                    // myChart.update();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
    // });


    
    // get log transaksi
    updateChart();
    setInterval(() => {
        updateChart();
        // getLogNotif();
    }, 10000);

</script>
</body>
</html>

