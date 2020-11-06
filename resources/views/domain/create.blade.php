@extends('layouts.app')

@section('title', 'Check web pages')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Page Analyzer</h1>
    <p class="lead">Check web pages for free</p>
    {{ Form::open(['url' => route('domains.store'), 'method' => 'post']) }}
    {{ Form::token() }}
    {{ Form::text('name', $value = $domain['name'], ['placeholder' => "https://www.example.com"]) }}
    {{ Form::submit('Check') }}
    {{ Form::close() }}
@endsection
