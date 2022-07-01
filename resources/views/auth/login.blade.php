<!DOCTYPE html>
<!-- 
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.2
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Log In BANK BKC
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/vendors.bundle.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/app.bundle.css') }}">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
        <link rel="mask-icon" href="{{ asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/fa-brands.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/toastr/toastr.css') }}">
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="{{ asset('assets/img/favicon.png') }}"  alt="SmartAdmin WebApp" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1">BANK BKC</span>
                                </a>
                            </div>
                            <a href="page_register.html" class="btn-link text-white ml-auto">
                                Create Account
                            </a>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url({{ asset('assets/img/svg/pattern-1.svg') }}) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="row">
                                <div class="col col-md-6 col-lg-7 hidden-sm-down">
                                    <h2 class="fs-xxl fw-500 mt-4 text-white">
                                        Report BANK BKC 
                                        <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                            Presenting you with the next level of innovative UX design and engineering. The most modular toolkit available with over 600+ layout permutations. Experience the simplicity of SmartAdmin, everywhere you go!
                                        </small>
                                    </h2>
                                    <a href="#" class="fs-lg fw-500 text-white opacity-70">Learn more &gt;&gt;</a>
                                    <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                                        <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
                                            Find us on social media
                                        </div>
                                        <div class="d-flex flex-row opacity-70">
                                            <a href="#" class="mr-2 fs-xxl text-white">
                                                <i class="fab fa-facebook-square"></i>
                                            </a>
                                            <a href="#" class="mr-2 fs-xxl text-white">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                            <a href="#" class="mr-2 fs-xxl text-white">
                                                <i class="fab fa-google-plus-square"></i>
                                            </a>
                                            <a href="#" class="mr-2 fs-xxl text-white">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                                    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                        Secure login
                                    </h1>
                                    <div class="card p-4 rounded-plus bg-faded">
                                        <form id="js-login" novalidate="">
                                        {{-- <form action="{{ route('login') }}" method="post"> --}}
                                            @csrf   
                                            <div class="form-group">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" id="username" name="email" class="form-control form-control-lg" placeholder="your id or email"  required>
                                                <div class="invalid-feedback">No, you missed this one.</div>
                                                <div class="help-block">Your unique username to app</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="password" value="" required>
                                                <div class="invalid-feedback">Sorry, you missed this one.</div>
                                                <div class="help-block">Your password</div>
                                            </div>
                                            <div class="form-group text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberme">
                                                    <label class="custom-control-label" for="rememberme"> Remember me</label>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-6 pr-lg-1 my-2">
                                                    <button type="submit" class="btn btn-info btn-block btn-lg">Reset </button>
                                                </div>
                                                <div class="col-lg-6 pl-lg-1 my-2">
                                                    <button id="js-login-btn" type="submit" class="btn-login btn btn-danger btn-block btn-lg">Secure login</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                                2022 © Team IT BKC 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/vendors.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/app.bundle.js') }}"></script>
        <script type="text/javascript" src="{{asset('assets/js/notifications/toastr/toastr.js') }}"></script>

        <script>
            $("#js-login").submit(function(event)
            {
                event.preventDefault()
               var serverUrl = "{{ env('APP_API') }}"+"api/login";
                $.ajax(serverUrl, {
                    type: "POST",
                    data: {
                        "username": $("#username").val(),
                        "password": $("#password").val()
                    },
                    beforeSend: function(){
                        $(".btn-login").attr('disabled',true).text('Loading...');
                    },
                    statusCode: {
                        401: function (response) {
                            toastr.error('User dan password anda masih salah.',  'Informasi', { 
                                positionClass: 'toast-bottom-right', 
                                "closeButton": true, 
                            });
                            $(".btn-login").removeAttr('disabled',true).text('Secure login')
                        },
                        400: function (response) {
                            toastr.error('User dan password anda masih salah.',  'Informasi', { 
                                positionClass: 'toast-bottom-right', 
                                "closeButton": true, 
                            });
                            $(".btn-login").removeAttr('disabled',true).text('Secure login')
                        },
                        404: function (response) {
                            toastr.error('Silakan cek jaringan koneksi server anda.',  'Informasi', { 
                                positionClass: 'toast-bottom-right', 
                                "closeButton": true, 
                            });
                            $(".btn-login").removeAttr('disabled',true).text('Secure login')
                        }
                    }, success: function (json) {
                        console.log(json);
                        toastr.success('Sukses.',  'Informasi', { 
                                positionClass: 'toast-bottom-right', 
                                "closeButton": true, 
                            });
                        window.location.href = "tks";
                        $(".btn-login").removeAttr('disabled',true).text('Secure login')
                    },
                });
                   
            });

        </script>
    </body>
</html>
