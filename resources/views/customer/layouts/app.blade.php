<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="{{ csrf_token() }}" name="csrf_token">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/splide.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/splide-core.min.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/splide/splide-sea-green.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <meta name="theme-color" content="#712cf9">

</head>
<body class="bg-secondary-subtle">
<main>
    @include('customer.app.header')
    {{--        @include('customer.app.slider')--}}
    <div class="container">
        @include('customer.app.alert')
{{--        @include('customer.app.carousel')--}}
        @yield('content')
    </div>
    @include('customer.app.footer')
</main>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/splide.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
