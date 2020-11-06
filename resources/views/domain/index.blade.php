@extends('layouts.app')

@section('title', 'domains')

@section('content')
    <h1>Domains</h1>
    <table>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Last check</td>
            <td>Status Code</td>
        </tr>
        @if ($domains->isNotEmpty())
            @foreach($domains as $domain)
        <tr>
            <td>{{ $domain->id }}</td>
            <td><a href="{{route('domains.show', ['id' => $domain->id])}}">{{ $domain->name }}</a></td>
            <td>{{ $domain->updated_at }}</td>
            <td></td>
        </tr>
            @endforeach
        @endif
    </table>
@endsection
