<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dashboard Site Projet Entreprise</title>
    @include('link')

</head>

<body>
    
    @guest
        @include('dashboard.login')
    @endguest 
    @auth 
    @include('dashboard.header')
    @include('dashboard.navbar')
    
    <main id="main" class="main">
        <section class="section dashboard">
            @yield('main')
        </section>
    </main>
    <!-- End #main -->
    @endauth
    
    @include('dashboard.footer')

</body>

</html>