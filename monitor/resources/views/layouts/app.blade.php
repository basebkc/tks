<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
		
		<title>Job List Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="header" content="">
		<!-- Call App Mode on ios devices -->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		 <!-- Remove Tap Highlight on Windows Phone IE -->
		<meta name="msapplication-tap-highlight" content="no">
		<!-- base css -->
        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/vendors.bundle.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/app.bundle.css') }}">
		{{-- <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/themes/cust-theme-8.css') }}"> --}}
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/toastr/toastr.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/fa-solid.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
				
		<script>

			// window.CONFIG = {
						
			// 	APP_URL: "{{env('APP_URL')}}",
				
			// };

		</script>

        @livewireStyles
		@yield('head')
	<!-- Place favicon.ico in the root directory -->
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">
    <style>
        .swal2-container {
           z-index: 10050;
        }
    </style>
        <!-- Scripts -->
   
    </head>
    <body class="mod-bg-1 ">
	
	<div class="pace"></div>
	<div class="page-wrapper">
		<div class="page-inner">
			<!-- BEGIN Left Aside -->
			<aside class="page-sidebar">
				<div class="page-logo">
					<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
						<img src="{{ asset('assets/img/favicon.png') }}" style="height:35px" alt="SmartAdmin WebApp" aria-roledescription="logo">
						<span class="page-logo-text mr-1">Job List Management</span>
						
						
					</a>
				</div>
				<!-- BEGIN PRIMARY NAVIGATION -->
				<nav id="js-primary-nav" class="primary-nav" role="navigation">
					<div class="nav-filter">
						<div class="position-relative">
							<input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
								   tabindex="0">
							<a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
							   data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
								<i class="fal fa-chevron-up"></i>
							</a>
						</div>
					</div>
					<div class="info-card">
						<img src="{{ asset('assets/img/admin.png') }}" class="profile-image rounded-circle" alt="">
						<div class="info-card-text">
							<a href="#" class="d-flex align-items-center text-white">
										<span class="text-truncate text-truncate-sm d-inline-block">
											@if($akses) {{ $akses->name }} @else {{ "" }} @endif
										</span>
							</a>
							<span class="d-inline-block text-truncate text-truncate-sm"> {{ $namakantor->n_kan }}</span>
						</div>
						<img src="{{ asset('assets/img/backgrounds/profil.jpg') }}" class="cover" alt="cover" width="100%">
						<a href="#" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
							<i class="fal fa-angle-down"></i>
						</a>
					</div>
					<ul id="js-nav-menu" class="nav-menu">
						@if(Auth::user()->role_id == 1)
						<li class="@if(isset($dashboard)) {{ "active" }} @endif">
							<a href="{{url('dashboard') }}" title="Dashboard" data-filter-tags="package info"  disabled="">
								<i class="fal fa-chart-pie"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">Dashboard</span>
							</a>
						</li>
						@endif
						<li class="@if(isset($tugas)) {{ "active" }} @endif">
							<a href="{{url('tugas') }}" title="Tracking Kredit" data-filter-tags="package info">
								<i class="fal fa-file"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">Form Request</span>
							</a>
						</li>
						<li class="@if(isset($tugastrack)) {{ "active" }} @endif">
							<a href="{{url('tugas/tracking') }}" title="Tracking Kredit" data-filter-tags="package info">
								<i class="fal fa-truck"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">Tracking Request</span>
							</a>
						</li>
						
						@if(Auth::user()->role_id == 1)
						<li  class="@if(isset($manaj)) {{ "active" }} @endif">
							<a href="#" title="Kredit" data-filter-tags="package info">
								<i class="fal fa-tag"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">Management Notification</span>
							</a>
							<ul>
								<li class="@if(isset($daftarwa)) {{ "active" }} @endif">
									<a href="{{url('notifikasi/daftarnasabah') }}" title="Daftar Nasabah" data-filter-tags="package info">
										<i class="fa fa-users"></i>
										<span class="nav-link-text" data-i18n="nav.package_info">Daftar Nasabah</span>
									</a>
								</li>
								<li class="@if(isset($master)) {{ "active" }} @endif">
									<a href="{{url('notifikasi/master') }}" title="Master Pesan" data-filter-tags="package info">
										<i class="fa fa-envelope"></i>
										<span class="nav-link-text" data-i18n="nav.package_info">Master Pesan</span>
									</a>
								</li>
								<li class="@if(isset($notiftab)) {{ "active" }} @endif">
									<a href="{{url('notifikasi') }}" title="Notifikasi Nasabah" data-filter-tags="package info">
										<i class="fal fa-bell"></i>
										<span class="nav-link-text" data-i18n="nav.package_info">Notifikasi Tabungan</span>
									</a>
								</li> 
							</ul>
						</li>
						@endif
					
						@if(Auth::user()->role_id == 1)
						<li>
							<a href="{{url('user') }}" title="User Management" data-filter-tags="user management">
								<i class="fal fa-user"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">User Management</span>
							</a>
						</li>
						<li>
							<a href="{{url('konfigurasi') }}" title="Konfigurasi" data-filter-tags="package info">
								<i class="fal fa-edit"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">Konfigurasi</span>
							</a>
						</li>
						@endif
					</ul>
				</nav>
				<!-- END PRIMARY NAVIGATION -->
			</aside>
			<!-- END Left Aside -->
			<div class="page-content-wrapper">
				<!-- BEGIN Page Header -->
				<header class="page-header" role="banner">
					<!-- we need this logo when user switches to nav-function-top -->
					<div class="page-logo">
						<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
							<img src="{{ asset('assets/img/logo.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
							<span class="page-logo-text mr-1"></span>
							<span
								class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
							<i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
						</a>
					</div>
					<!-- DOC: nav menu layout change shortcut -->
					<div class="hidden-md-down dropdown-icon-menu position-relative">
						<a href="#" class="header-btn btn js-waves-off" data-action="toggle"
						   data-class="nav-function-hidden" title="Hide Navigation">
							<i class="ni ni-menu"></i>
						</a>
						<ul>
							<li>
								<a href="#" class="btn js-waves-off" data-action="toggle"
								   data-class="nav-function-minify" title="Minify Navigation">
									<i class="ni ni-minify-nav"></i>
								</a>
							</li>
							<li>
								<a href="#" class="btn js-waves-off" data-action="toggle"
								   data-class="nav-function-fixed" title="Lock Navigation">
									<i class="ni ni-lock-nav"></i>
								</a>
							</li>
						</ul>
					</div>
					<!-- DOC: mobile button appears during mobile width -->
					<div class="hidden-lg-up">
						<a href="#" class="header-btn btn press-scale-down" data-action="toggle"
						   data-class="mobile-nav-on">
							<i class="ni ni-menu"></i>
						</a>
					</div>
					
					<div class="ml-auto d-flex">
						  <!-- app settings -->
						<div class="hidden-md-down">
							<a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
								<i class="fal fa-cog"></i>
							</a>
						</div>
						<!-- app user menu -->
						<div>
							<a href="#" data-toggle="dropdown" title=""
							   class="header-icon d-flex align-items-center justify-content-center ml-2">
								<img src="{{ asset('assets/img/admin.png') }}" class="profile-image rounded-circle"
									 alt="logout" style="object-position: top;
										object-fit: cover;
										height: 50px;
										width: 50px;"> @if($akses) {{ $akses->name }} @else {{ "" }} @endif
							</a>
							<div class="dropdown-menu dropdown-menu-animated dropdown-lg">
								<div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
									<div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
											<span class="mr-2">
												<img src="{{ asset('assets/img/admin.png') }}"
													 class="rounded-circle profile-image" alt="userPhoto" style="
													object-fit: cover;
													object-position: top;
												">
											</span>
										<div class="info-card-text">
											<div class="fs-lg text-truncate text-truncate-lg">@if($akses) {{ $akses->name }} @else {{ "" }} @endif</div>
											<span class="text-truncate text-truncate-md opacity-80">{{ $namakantor->n_kan }}</span>
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
							
								<div class="dropdown-item" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
							</div>
						</div>
					</div>
					
				</header>
				<!-- END Page Header -->
				<!-- BEGIN Page Content -->
				@yield('content')
			 
				<div class="blockConnection"></div>
				<!-- this overlay is activated only when mobile menu is triggered -->
				<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
				<!-- END Page Content -->
				<!-- BEGIN Page Footer -->
				<footer class="page-footer" role="contentinfo">
					<div class="d-flex align-items-center flex-1 text-muted">
							<span class="hidden-md-down fw-700">
							 Tim IT Bank BKC. © 2021</span>
					</div>
					<div>
						<ul class="list-table m-0">
							<li class="pl-3"><a href="#" class="text-secondary fw-700">Documentation</a></li>
							<li class="pl-3 fs-xl"><a href="#" class="text-secondary" target="_blank">
									<i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</footer>
		   
			</div>
		</div>
	</div>
     
	<script src="{{ asset('assets/js/vendors.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/app.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/notifications/toastr/toastr.js') }}"></script>
	<script src="{{ asset('assets/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
	<script src="{{asset('assets/js/datagrid/datatables/jquery.dataTables.min.js') }}"></script>
	@yield('scripts')
	
    </body>
</html>
