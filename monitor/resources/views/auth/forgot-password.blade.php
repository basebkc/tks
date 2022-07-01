<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>Lupa Password</title>

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
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf   
					<p class="legend">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}<span class="fa fa-hand-o-down"></span></p>
					<div class="input">
						<input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus>
						<span class="fa fa-envelope"></span>
					</div>
					
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red">{{ $message }}</strong>
                        </span>
                    @enderror
                    
					<button style="width: 280px;" type="submit" class="btn submit">
                       
                        <span class="fa fa-sign-in"> {{ __('Email Password Reset Link') }}</span>
					</button>
                   
				</form>
            </div>
		</div>
		<!-- //content -->
		<!-- copyright -->

	</div>
</body>

</html>


<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
