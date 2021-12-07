<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/header-admin.css') }}" rel="stylesheet">
    <link href="{{ mix('css/body-admin.css') }}" rel="stylesheet">
    <link href="{{ mix('css/style-admin.css') }}" rel="stylesheet">
    <link href="{{ mix('css/cadproduto-admin.css') }}" rel="stylesheet">
    <link href="{{ mix('css/global.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/chart.min.css')}}">
    <link rel="stylesheet" href="{{ mix('css/table.css') }}"> 
    <link rel="stylesheet" href="{{ mix('css/datatables.css') }}">  
    <link rel="stylesheet" href="{{ mix('css/responsive.css') }}">  
    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script> 
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/funcoes.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('js/datatables.sum.js') }}"></script>   
    <title>Ecommerce</title>
</head>
<body>
    @include('admin.includes.header')
    <main>
        @yield('body')
    </main>
</body>
</html>
