<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Analyzer - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="d-flex flex-column" style="font-family: Nunito,sans-serif;font-size: .9rem;line-height: 1.6;">
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" style="font-size: 1.125rem;line-height: 1.5;" href="{{ route('home') }}">Analyzer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link{{ App\Helpers\Helpers::getClassActive('home') }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ App\Helpers\Helpers::getClassActive('domains.index') }}" href="{{ route('domains.index') }}">Domains</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@yield('content')

<footer class="border-top py-3 mt-5">
    <div class="container-lg">
        <div class="text-center">
            created by
            <a href="https://github.com/kalash-job">Nikolay K</a>
        </div>
    </div>
</footer>
