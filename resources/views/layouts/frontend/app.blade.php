<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,700%7CSource+Sans+Pro:300i,400,400i,600,700">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/magnific-popup/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    <!-- jQuery toast  -->
    <link rel="stylesheet" href="{{ asset('assets/latest/css/toastr.min.css') }}">
    @stack('css')

</head>
<body>
    <!-- Preloader -->
    {{-- <div class="preLoader"></div> --}}

    <!-- Main header -->
    @include('layouts.frontend.partial.header')
    <!-- End of Main header -->

    @yield('content')


    <!-- Footer -->
    @include('layouts.frontend.partial.footer')
    <!-- End of Footer -->

    <!-- Back to top -->
    <div class="back-to-top">
        <a href="#"> <i class="fa fa-chevron-up"></i></a>
    </div>


    <!-- JS Files -->
    <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/waypoints/sticky.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/retinajs/retina.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/plugins/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/menu.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/custom.js') }}"></script>

    <!-- jQuery toast  -->
    <script src="{{ asset('assets/latest/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    <script>
        @if($errors->any()) 
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}','Error',{
                    closeButton:true,
                    progressBar:true,
                })
            @endforeach
        @endif
    </script>
    @stack('js')
</body>
</html>
