@extends('layouts.app')

@section('title', $domain->name)

@section('content')
    <main class="flex-grow-1">
        @include('flash::message')
        <div class="container-lg">
            <h1 class="mt-5 mb-3" style="font-size: 2.25rem;">Site: {{ $domain->name }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap" style="font-size: 1rem;">
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
            </div>
            <h2 class="mt-5 mb-3" style="font-size: 1.8rem;">Checks</h2>
            {{ Form::open(['url' => route('domains.checks.store', ['domain' => $domain->id]), 'method' => 'post']) }}
            {{ Form::token() }}
            {{ Form::submit('Run check', ['class' => 'btn btn-primary', "style" => "font-size: 0.9rem; background-color: #3490dc;"]) }}
            {{ Form::close() }}
            <table class="table table-bordered table-hover text-nowrap mt-3">
                <tr>
                    <th>Id</th>
                    <th>Status Code</th>
                    <th>h1</th>
                    <th>Keywords</th>
                    <th>Description</th>
                    <th>Created At</th>
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

        </div>
    </main>
@endsection
