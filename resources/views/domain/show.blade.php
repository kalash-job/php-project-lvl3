@extends('layouts.app')

@section('title', $domain->name)

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <h1>Site: {{ $domain->name }}</h1>
    <table>
        <tr>
            <td>id</td>
            <td>{{ $domain->id }}</td>
        </tr>
        <tr>
            <td>name</td>
            <td>{{ $domain->name }}</td>
        </tr>
        <tr>
            <td>created_at</td>
            <td>{{ $domain->created_at }}</td>
        </tr>
        <tr>
            <td>updated_at</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
    </table>
    <h2>Checks</h2>
    {{ Form::open(['url' => route('domains.checks.store', ['id' => $domain->id]), 'method' => 'post']) }}
    {{ Form::token() }}
    {{ Form::submit('Run check') }}
    {{ Form::close() }}
    <table>
        <tr>
            <td>Id</td>
            <td>Status Code</td>
            <td>h1</td>
            <td>Keywords</td>
            <td>Description</td>
            <td>Created At</td>
        </tr>
        @if ($domainChecks->isNotEmpty())
                    @foreach ($domainChecks->all() as $domainCheck)
                <tr>
                    <td>{{ $domainCheck->id }}</td>
                    <td>{{ $domainCheck->status_code }}</td>
                    <td>{{ Str::limit($domainCheck->h1, 9) }}</td>
                    <td>{{ Str::limit($domainCheck->keywords, 30) }}</td>
                    <td>{{ Str::limit($domainCheck->description, 30) }}</td>
                    <td>{{ $domainCheck->created_at }}</td>
                </tr>
                    @endforeach
        @endif
    </table>
@endsection
