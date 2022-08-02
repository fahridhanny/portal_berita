<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 mr-auto">
                <div class="b-logo">
                    <a href="/">
                        <img src="{{ url('img/logo.png') }}" alt="Logo">
                    </a>
                </div>
            </div>
            {{-- <div class="col-lg-6 col-md-4">
                <div class="b-ads">
                    <a href="https://htmlcodex.com">
                        <img src="{{ url('img/ads-1.jpg') }}" alt="Ads">
                    </a>
                </div>
            </div> --}}
            <div class="col-lg-3 col-md-4 ml-auto">
                <div class="b-search">
                    <form action="/{{ app()->getLocale() }}/search" method="get">
                        <input type="text" placeholder="Search" name="q">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="/" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Sub Item 1</a>
                            <a href="#" class="dropdown-item">Sub Item 2</a>
                        </div>
                    </div>
                    <a href="/{{ app()->getLocale() }}/contact" class="nav-item nav-link">Contact Us</a>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item @if(app()->getLocale() == 'id') active @endif">
                            <a class="nav-link" href="/lang/id">ID</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">|</span>
                        </li>
                        <li class="nav-item @if(app()->getLocale() == 'en') active @endif">
                            <a class="nav-link" href="/lang/en">EN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</div>