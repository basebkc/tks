<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
		
		<title>BANK BKC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="header" content="">
		<!-- Call App Mode on ios devices -->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		 <!-- Remove Tap Highlight on Windows Phone IE -->
		<meta name="msapplication-tap-highlight" content="no">
		<!-- base css -->
        <!-- Fonts -->
       

        <!-- Styles -->
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/vendors.bundle.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/app.bundle.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/toastr/toastr.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/fa-solid.css') }}">
		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
		

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
	<div class="pace"></div>
	<div class="page-wrapper">
		<div class="page-inner">
			<!-- BEGIN Left Aside -->
			<aside class="page-sidebar">
				<div class="page-logo">
					<a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
						<img src="{{ asset('assets/img/favicon.png') }}" style="height:35px" alt="SmartAdmin WebApp" aria-roledescription="logo">
						<span class="page-logo-text mr-1">REPORT BKC</span>
						
						
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
											 {{ $akses }}
										</span>
							</a>
							<span class="d-inline-block text-truncate text-truncate-sm"> {{ $namakantor }}</span>
						</div>
						<img src="{{ asset('assets/img/backgrounds/profil.jpg') }}" class="cover" alt="cover" width="100%">
						<a href="#" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
							<i class="fal fa-angle-down"></i>
						</a>
					</div>
					<ul id="js-nav-menu" class="nav-menu">
						
						<li class="@if(isset($dashboard)) {{ "active" }} @endif">
							<a href="{{url('dashboard') }}" title="Dashboard" data-filter-tags="package info"  disabled="">
								<i class="fal fa-chart-pie"></i>
								<span class="nav-link-text" data-i18n="nav.package_info">Dashboard</span>
							</a>
						</li>
						
						<li  class="@if(isset($menutks)) {{ "active open" }} @endif">
							<a  title="Laporan TKS" data-filter-tags="laporan tks">
								<i class=" fal fa-credit-card-front"></i>
								<span class="nav-link-text" style="color:white" data-i18n="nav.package_info">Laporan TKS</span>
							</a>
							<ul>
								<li class="@if(isset($tks)) {{ "active" }} @endif">
									<a href="{{url('tks') }}" title="Laporan TKS" data-filter-tags="package info">
										<i class="fal fa-file"></i>
										<span class="nav-link-text" data-i18n="nav.package_info">Laporan TKS</span>
									</a>
								</li>
								<li class="@if(isset($menulikuid)) {{ "active open" }} @endif">
									<a title="Mapping Kode Perkiraan" title="Daftar Nasabah" data-filter-tags="package info">
										<i class="fal fa-cog"></i>
										<span class="nav-link-text" style="color:white" data-i18n="nav.package_info">Mapping Kode Perkiraan</span>
									</a>
									<ul>
										<li class="@if(isset($likuid)) {{ "active" }} @endif">
											<a href="{{url('setting/likuid') }}" title="Master Pesan" data-filter-tags="package info">
												<span class="nav-link-text" data-i18n="nav.package_info">Likuditas</span>
											</a>
										</li>
									</ul>
								</li>
								
							</ul>
						</li>
						
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
										width: 50px;">  {{ $akses }}  
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
											<div class="fs-lg text-truncate text-truncate-lg"> {{ $akses }}  </div>
											<span class="text-truncate text-truncate-md opacity-80">{{ $namakantor }}</span>
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
				<!-- BEGIN Page Settings -->
				<div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-right modal-md">
						<div class="modal-content">
							<div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
								<h4 class="m-0 text-center color-white">
									Layout Settings
									<small class="mb-0 opacity-80">User Interface Settings</small>
								</h4>
								<button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true"><i class="fal fa-times"></i></span>
								</button>
							</div>
							<div class="modal-body p-0">
								<div class="settings-panel">
									<div class="mt-4 d-table w-100 px-5">
										<div class="d-table-cell align-middle">
											<h5 class="p-0">
												App Layout
											</h5>
										</div>
									</div>
									<div class="list" id="fh">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
										<span class="onoffswitch-title">Fixed Header</span>
										<span class="onoffswitch-title-desc">header is in a fixed at all times</span>
									</div>
									<div class="list" id="nff">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
										<span class="onoffswitch-title">Fixed Navigation</span>
										<span class="onoffswitch-title-desc">left panel is fixed</span>
									</div>
									<div class="list" id="nfm">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
										<span class="onoffswitch-title">Minify Navigation</span>
										<span class="onoffswitch-title-desc">Skew nav to maximize space</span>
									</div>
									<div class="list" id="nfh">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
										<span class="onoffswitch-title">Hide Navigation</span>
										<span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
									</div>
									<div class="list" id="nft">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
										<span class="onoffswitch-title">Top Navigation</span>
										<span class="onoffswitch-title-desc">Relocate left pane to top</span>
									</div>
									<div class="list" id="mmb">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
										<span class="onoffswitch-title">Boxed Layout</span>
										<span class="onoffswitch-title-desc">Encapsulates to a container</span>
									</div>
									<div class="expanded">
										<ul class="">
											<li>
												<div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
											</li>
											<li>
												<div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
											</li>
											<li>
												<div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
											</li>
											<li>
												<div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
											</li>
										</ul>
										<div class="list" id="mbgf">
											<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
											<span class="onoffswitch-title">Fixed Background</span>
										</div>
									</div>
									<div class="mt-4 d-table w-100 px-5">
										<div class="d-table-cell align-middle">
											<h5 class="p-0">
												Mobile Menu
											</h5>
										</div>
									</div>
									<div class="list" id="nmp">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
										<span class="onoffswitch-title">Push Content</span>
										<span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
									</div>
									<div class="list" id="nmno">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
										<span class="onoffswitch-title">No Overlay</span>
										<span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
									</div>
									<div class="list" id="sldo">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
										<span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
										<span class="onoffswitch-title-desc">Content overlaps menu</span>
									</div>
									<div class="mt-4 d-table w-100 px-5">
										<div class="d-table-cell align-middle">
											<h5 class="p-0">
												Accessibility
											</h5>
										</div>
									</div>
									<div class="list" id="mbf">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
										<span class="onoffswitch-title">Bigger Content Font</span>
										<span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
									</div>
									<div class="list" id="mhc">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
										<span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
										<span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
									</div>
									<div class="list" id="mcb">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
										<span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
										<span class="onoffswitch-title-desc">color vision deficiency</span>
									</div>
									<div class="list" id="mpc">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
										<span class="onoffswitch-title">Preloader Inside</span>
										<span class="onoffswitch-title-desc">preloader will be inside content</span>
									</div>
									<div class="mt-4 d-table w-100 px-5">
										<div class="d-table-cell align-middle">
											<h5 class="p-0">
												Global Modifications
											</h5>
										</div>
									</div>
									<div class="list" id="mcbg">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
										<span class="onoffswitch-title">Clean Page Background</span>
										<span class="onoffswitch-title-desc">adds more whitespace</span>
									</div>
									<div class="list" id="mhni">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
										<span class="onoffswitch-title">Hide Navigation Icons</span>
										<span class="onoffswitch-title-desc">invisible navigation icons</span>
									</div>
									<div class="list" id="dan">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
										<span class="onoffswitch-title">Disable CSS Animation</span>
										<span class="onoffswitch-title-desc">Disables CSS based animations</span>
									</div>
									<div class="list" id="mhic">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
										<span class="onoffswitch-title">Hide Info Card</span>
										<span class="onoffswitch-title-desc">Hides info card from left panel</span>
									</div>
									<div class="list" id="mlph">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
										<span class="onoffswitch-title">Lean Subheader</span>
										<span class="onoffswitch-title-desc">distinguished page header</span>
									</div>
									<div class="list" id="mnl">
										<a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
										<span class="onoffswitch-title">Hierarchical Navigation</span>
										<span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
									</div>
									<div class="list mt-1">
										<span class="onoffswitch-title">Global Font Size <small>(RESETS ON REFRESH)</small> </span>
										<div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
											<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
												<input type="radio" name="changeFrontSize"> SM
											</label>
											<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
												<input type="radio" name="changeFrontSize" checked=""> MD
											</label>
											<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
												<input type="radio" name="changeFrontSize"> LG
											</label>
											<label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
												<input type="radio" name="changeFrontSize"> XL
											</label>
										</div>
										<span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem
											values</span>
									</div>
									<hr class="mb-0 mt-4">
									<div class="mt-2 d-table w-100 pl-5 pr-3">
										<div class="fs-xs text-muted p-2 alert alert-warning mt-3 mb-2">
											<i class="fal fa-exclamation-triangle text-warning mr-2"></i>The settings below uses localStorage to load
											the external CSS file as an overlap to the base css. Due to network latency and CPU utilization, you may
											experience a brief flickering effect on page load which may show the intial applied theme for a split
											second. Setting the prefered style/theme in the header will prevent this from happening.
										</div>
									</div>
									<div class="mt-2 d-table w-100 pl-5 pr-3">
										<div class="d-table-cell align-middle">
											<h5 class="p-0">
												Theme colors
											</h5>
										</div>
									</div>
									<div class="expanded theme-colors pl-5 pr-3">
										<ul class="m-0">
											<li>
												<a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
											</li>
											<li>
												<a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-1.css') }}" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>
											</li>
											<li>
												<a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-2.css') }}" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>
											</li>
											<li>
												<a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-3.css') }}" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>
											</li>
											<li>
												<a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-4.css') }}" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>
											</li>
											<li>
												<a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-5.css') }}" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>
											</li>
											<li>
												<a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-6.css') }}" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>
											</li>
											<li>
												<a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-7.css') }}" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>
											</li>
											<li>
												<a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-8.css') }}" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
											</li>
											<li>
												<a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-9.css') }}" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>
											</li>
											<li>
												<a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-10.css') }}" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>
											</li>
											<li>
												<a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-11.css') }}" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>
											</li>
											<li>
												<a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-12.css') }}" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
											</li>
											<li>
												<a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="{{ asset('assets/css/themes/cust-theme-13.css') }}" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>
											</li>
										</ul>
									</div>
									<hr class="mb-0 mt-4">
									<div class="pl-5 pr-3 py-3 bg-faded">
										<div class="row no-gutters">
											<div class="col-6 pr-1">
												<a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
											</div>
											<div class="col-6 pl-1">
												<a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
											</div>
										</div>
									</div>
								</div> <span id="saving"></span>
							</div>
						</div>
					</div>
				</div>
        <!-- END Page Settings -->
			</div>
		</div>
	</div>
     
	<script src="{{ asset('assets/js/vendors.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/app.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/notifications/toastr/toastr.js') }}"></script>
	@yield('scripts')

    </body>
</html>
