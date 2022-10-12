<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/index" class="logo d-flex align-items-center">
            <i class="bi bi-house-door-fill"></i>
            <span class="d-none d-lg-block" style="font-size: 18px;">Site Projet entreprise</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="/search_form">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="text" name="query" placeholder="Écrivez votre recherche" value="@if(Route::currentRouteName() == 'search')<?php echo substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], "query=") + 6); ?>@endif" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <!-- End Search Bar -->

    <script>
        function show_bilan() {
            document.getElementById('button_show_bilan').style.display = "none";
            document.getElementById('show_bilan').style.display = "block";
        }

        function close_bilan() {
            document.getElementById('button_show_bilan').style.display = "block";
            document.getElementById('show_bilan').style.display = "none";
        }
    </script>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!-- End Search Icon-->

            <li class="nav-item">
                <a class="nav-link collapsed" target="_blank" toggle="collapse" onclick="show_bilan()">
                    <span id="button_show_bilan">
                        
                        @php
                        use Cmgmyr\Messenger\Traits\Messagable;
                        $count = Auth::user()->newThreadsCount();
                        @endphp
                        @if($count > 0)
                        <span class="bg-danger border-0 text-center text-light border-danger">  {{ $count }}
                            Nouveaux messages 
                            <i class="bi bi-chevron-right ms-auto"></i> 
                         </span>
                        @endif
                    </span>
                </a>
                <div class="row flex float-left" id="show_bilan" style="display: none;"> 
                    <div class="col-md-8" style="float: left;">
                        <a href="/messages" target="_blank" rel="noopener noreferrer">
                            messages</a>
                    </div>
                    <div class="col-md-4" style="float: left;">
                        <a href="#" onclick="close_bilan()" class="btn btn-lg"><sup class="bg-danger pt-1" style="padding: 5px;color: #fff;">x</sup></a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="https://i.ibb.co/hd2bPrg/ff.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                </a>
                <!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <span>{{ Auth::user()->role }} </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('users.show', Auth::user()->id) }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form id="logout" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->online = 0 }}" name="online">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>{{ __('Log Out') }}</span>
                                </a>
                            </li>
                        </form>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header>
<!-- End Header -->
