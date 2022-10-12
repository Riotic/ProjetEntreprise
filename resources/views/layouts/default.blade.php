<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>

        <title>Index</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Henny+Penny&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">



        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/burgersStyle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
        <link rel="stylesheet" href="{{ asset('css/cookiesManagement.css') }}">
        <body>
            <div class="container">
                <div class="header">
                    <div class="logo_container">
                        {{-- <img src="{{asset('images/logo.png')}}" alt="logo"> --}}
                    </div>
                    <div>
                        <h1>Register</h1>
                    </div>
                    <div>
                        <div class="nav">
                        <ul>
                            @if(Route::has('login'))
                            @auth
                                <li>{{ Auth::user()->name }} {{ Auth::user()->surname }}</li>
                                             {{-- affiche nom; prénom utilisateurs --}}
                                            {{-- @if (Auth::user()->role=='admin')
                                            <li><a href="{{ url('/admin') }}">Admin</a><hr></li>
                                            @endif --}}
                                <li><a href="{{ url('/users') }}">Accueil</a></li>

                                <form  id="logout" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::user()->online = 0 }}" name="online">
                                    <li><a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                </li></form>
                                <li><a href="{{ url('/synthstucs/create') }}">Création TUC</a></li>
                                <li><a href="{{ url('/synthstues/create') }}">Création TUE</a></li>
                                <li><a href="{{ url('/synthstuts/create') }}">Création TUT</a></li>
                                <li><a href="{{ route('synthstucs.index', Auth::user()->id) }}">Mes créations TUC</a></li>
                                <li><a href="{{ route('synthstues.index', Auth::user()->id) }}">Mes créations TUE</a></li>
                                <li><a href="{{ route('synthstuts.index', Auth::user()->id) }}">Mes créations TUT</a></li>
                            @endif
                            @endauth
                        </ul>
                        </div>

                    </div>
                </div>
                @if(Route::has('login'))
                    @auth
                        <div class="header_responsiv">
                            <div>
                                <input type="checkbox" class="buttonToggle" id="btnLogin">
                                <label for="btnLogin" class="buttonIcon">
                                        {{-- <div class="sidebar">
                                            {{ Auth::user()->name }} {{ Auth::user()->surname }}<hr>
                                            {{-- affiche nom; prénom utilisateurs --}/}
                                            @if (Auth::user()->role=='admin')
                                            <a href="{{ url('/admin') }}">Admin</a><hr>
                                            @else
                                            <p>test</p>
                                            @endif
                                            <a href="{{ url('/products') }}">Accueil</a><hr>
                                            <a href="{{ url('/cart') }}" id="cartTotalItems2">Panier</a><hr>
                                            <form  id="logout" method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</a>
                                            </form><hr>
                                        </div> --}}
                                    <div class="buttonItem buttonItem--element1 "></div>
                                    <div class="buttonItem buttonItem--element2 "></div>
                                    <div class="buttonItem buttonItem--element3 "></div>
                                    <div class="buttonItem buttonItem--element3 "></div>
                                </label>
                            </div>
                        </div>
                    @endauth
                @endif
                <div class="div_default">
                    @yield('main')
                </div>

                <footer class="footer">
                    {{-- <a href="https://fr-fr.facebook.com/?nocaa=1%22%3E">
                        <img class="down"  src="{{asset('images/logo.png')}}" alt="logofacebook">
                    </a>
                    <a href="https://twitter.com/%22%3E">
                        <img class="down" src="{{asset('images/logo.png')}}" alt="twitter">
                    </a> --}}
                </footer>
            </div>

        </body>
        </html>
