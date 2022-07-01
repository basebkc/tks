<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>Sign In</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- style css  --}}
	
<link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/login/css/font-awesome.min.css') }}">
<style>
    .input input {
    width: 100%;
    padding: 13px 10px 13px 34px;
    display: block;
    border: none;
    border: 1px solid #1cc7d0;
    color: #000;
    box-sizing: border-box;
    font-size: 13px;
    outline: none;
    letter-spacing: 1px;
    background: #fff;
    -webkit-box-shadow: 2px 5px 16px 2px rgb(16 16 16 / 18%);
    -moz-box-shadow: 2px 5px 16px 2px rgba(16, 16, 16, 0.18);
    box-shadow: 2px 5px 16px 2px rgb(16 16 16 / 18%);
}
    </style>

</head>


<body>
	<div class="main-bg">
		<!-- title -->
		<h1></h1>
		<!-- //title -->
		<!-- content -->
		<div class="sub-main-w3">
			<div class="bg-content-w3pvt">
				<div class="top-content-style">
					<img src="{{ asset('assets/img/logo.png') }}" alt="" />
				</div>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf   
					<p class="legend">Login Disini<span class="fa fa-hand-o-down"></span></p>
					<div class="input">
						<input type="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" required="">
						<span class="fa fa-envelope"></span>
                        
                        
					</div>
					<div class="input">
						<input type="password" placeholder="Password" name="password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
						<span class="fa fa-unlock"></span>
                        
					</div>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red">{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('password')
                            <span class="invalid-feedback fa fa-unlock" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                        @enderror
					<button type="submit" class="btn submit">
                        <span class="fa fa-sign-in"></span>
					</button>
                   
				</form>

                @if (Route::has('password.request'))
                    <a class="bottom-text-w3ls" href="{{ route('password.request') }}">
                        {{ __('Lupa password anda?') }}
                    </a>
                @endif

            </div>
		</div>
        
	</div>
</body>

</html>
