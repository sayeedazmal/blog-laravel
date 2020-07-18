<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Blog') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{ asset('assets/Frontend/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/Frontend/css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/Frontend/css/ionicons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack('css')

</head>
<body>

@include('layouts.Frontend.partial.header')

@yield('content')

@include('layouts.Frontend.partial.footer')

</body>

<!-- SCIPTS -->

<script src="{{ asset('assets/Frontend/js/jquery-3.1.1.min.js')}}"></script>

<script src="{{ asset('assets/Frontend/js/tether.min.js')}}"></script>

<script src="{{ asset('assets/Frontend/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/Frontend/js/swiper.js')}}"></script>

<script src="{{ asset('assets/Frontend/js/scripts.js')}}"></script>

{{-- toastr js --}}
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

<script>

    @if ($errors->any())

      @foreach ($errors->all() as $error)
          toastr.error('{{ $error }}','Error',{
            closeButton:true,
            progressBar:true,
      });
      @endforeach
    @endif
</script>
@stack('js')
</html>
