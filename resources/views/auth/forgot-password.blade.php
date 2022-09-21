@extends("dashboard.home")
@section("main")
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">

            </a>
        </x-slot>
        <div class="formclass">
            <h1 id="SignUpTitle" >Forgot your password? No problem.</h1>
            <p class="RoadToLogIn"> Just let us know your email address and <br/>we will email you a password reset link that will allow you to choose a new one.</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- Email Address -->
            <input type="email" placeholder="email" name="email" id="email" size="10" :value="old('email')" required autofocus>
            <p><a class="RoadToLogIn" href="{{ route('login') }}">
                {{ __('Need to go back to login? Clic here') }}
                <br/>
            </a></p>
            <div><x-button class="buttonlike" href="{{ route('login') }}">{{ __('Email Password Reset Link') }}</x-button></div>
        </form>
    </div>
    </x-auth-card>
</x-guest-layout>
@endsection
