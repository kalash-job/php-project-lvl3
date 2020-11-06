@extends('layouts.app')

@section('title', $domain->name)

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
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
@endsection
