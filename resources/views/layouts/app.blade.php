<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('layouts.particles.meta')

    @include('layouts.particles.favicons')
    @include('layouts.particles.gtm-script')


    <link rel="canonical"
          href="{{ \Illuminate\Support\Facades\URL::current() }}">
    <link rel="preconnect"
          href="https://fonts.googleapis.com">
    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Raleway:wght@100;300;500;600&display=swap"
        rel="stylesheet">

    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">

</head>

<body itemscope itemtype="https://schema.org/WebPage">
@include('layouts.particles.gtm-noscript')

<main>
    @yield('content')
</main>
<script defer src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
