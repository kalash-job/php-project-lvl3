@extends('layouts.app')

@section('title', 'Check web pages')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">Not a valid url</div>
    @endif
    <main class="flex-grow-1">
        <div class="jumbotron jumbotron-fluid bg-dark">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8 mx-auto text-white">
                        <h1 class="display-3">Page Analyzer</h1>
                        <p class="lead" style="font-size: 1.125rem;line-height: 1.5;">Check web pages for free</p>
                        {{ Form::open(['url' => route('domains.store'), 'method' => 'post', 'class' => ['d-flex', 'justify-content-center']]) }}
                        {{ Form::token() }}
                        {{ Form::text('name', $value = $domain['name'], ['placeholder' => "https://www.example.com",
'class' => ['form-control', 'form-control-lg'],
"style" => "font-size: 1.125rem;"]) }}
                        {{ Form::submit('Check', ['class' => ['btn', 'btn-lg', 'btn-primary', 'ml-3', 'px-5', 'text-uppercase'],
"style" => "font-size: 1.125rem; background-color: #3490dc;"]) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
