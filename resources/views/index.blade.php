<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" property="og:title" content="@yield('meta_title', 'Default Title')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default Keywords')">
    <meta name="description" property="og:description" content="@yield('meta_description', 'Default Description')">
    <title>@yield('meta_title', 'Default Title')</title>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- FontAwesome --}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('css/solid.css') }}" rel="stylesheet">
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/brands.js') }}"></script>
    <script src="{{ asset('js/solid.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    
    {{-- JQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    
    {{-- Bootstrap --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- DataTables --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet">  --}}

    <!-- CSS Libraries -->
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick-theme.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- JavaScript Libraries -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>

    
    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- Swiper JS --}}
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    @include('layouts.navbar')
        
    @yield('content')

    @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</body>
</html>