@extends("dashboard.home")
@section("main")
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="formclass">

        <h1 id="SignUpTitle" >Sign in</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
         <!-- Email Address -->
        <p><input type="email" name="email" placeholder="Email" :value="old('email')" required autofocus /></p>

            <!-- Password -->
        <p><input type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password"/></p>
            <!-- Remember Me -->
        <label for="remember_me"><input id="remember_me" type="checkbox" name="remember"><span >{{ __('   Remember me') }}</span></label>

        <p >
                @if (Route::has('password.request'))
                    <a class="RoadToLogIn" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?  Cliquez ici!') }}
                    </a>
                    <a href="{{ route('register') }}" class="RoadToLogIn">
                        <br/>{{ __('Vous n\'avez pas de compte? Cliquez ici pour en créer un') }}
                    </a>
                @endif
        </p>
        <x-button>
                    {{ __('Log in') }}
        </x-button>
        </form>
    </div>
    </x-auth-card>
</x-guest-layout>
@endsection
