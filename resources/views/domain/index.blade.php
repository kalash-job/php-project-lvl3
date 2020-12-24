@extends('layouts.app')

@section('title', 'domains')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3" style="font-size: 2.25rem;">Domains</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap" style="font-size: 1rem;">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last check</th>
                        <th>Status Code</th>
                    </tr>
                    @if ($domains->isNotEmpty())
                        @foreach($domains as $domain)
                            <tr>
                                <td>{{ $domain->id }}</td>
                                <td><a href="{{route('domains.show', $domain->id)}}">{{ $domain->name }}</a>
                                </td>
                                <td>{{ $lastChecks[$domain->id][0]->created_at ?? '' }}</td>
                                <td>{{ $lastChecks[$domain->id][0]->status_code ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </main>
@endsection
