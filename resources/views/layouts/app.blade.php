<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Analyzer - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<header>
    <a href="{{ route('domains.create') }}">Analyzer</a>
    <a href="{{ route('domains.create') }}">Home</a>
    <a href="{{ route('domains.index') }}">Domains</a>
</header>
<main>
    <div>
        <h1>@yield('header')</h1>
        <div>
            @yield('content')
        </div>
    </div>
</main>
<footer>
    <p>created by
        <a href="https://github.com/kalash-job">Nikolay K</a>
    </p>
</footer>
