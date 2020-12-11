<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainController extends Controller
{
    public function create()
    {
        $domain = ['name' => ''];
        return view('domain.create', compact('domain'));
    }

    private function normalize(string $domain): string
    {
        $domainParsed = parse_url($domain);
        $scheme = mb_strtolower($domainParsed['scheme'] ?? null);
        $host = mb_strtolower($domainParsed['host'] ?? null);
        return "$scheme://$host";
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|url',
        ]);
        $domain = $this->normalize($request->get('name'));

        $idOfDomain = DB::table('domains')
            ->select('id')
            ->where('name', $domain)
            ->get();
        if ($idOfDomain->isNotEmpty()) {
            flash('Url already exists');
            return redirect()->route('domains.show', ['id' => $idOfDomain->implode('id')]);
        }

        $id = DB::table('domains')->insertGetId([
            'name' => $domain,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        flash('Url has been added');
        return redirect()->route('domains.show', ['id' => $id]);
    }

    public function show($id)
    {
        $domain = DB::table('domains')
            ->where('id', $id)
            ->get();
        if ($domain->isEmpty()) {
            abort(404);
        }
        $domainChecks = DB::table('domain_checks')
            ->where('domain_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('domain.show', ['domain' => $domain[0], 'domainChecks' => $domainChecks]);
    }

    public function index()
    {
        $domains = DB::table('domains')
            ->leftJoin('domain_checks', 'domains.id', '=', 'domain_checks.domain_id')
            ->select('domains.id', 'domains.name', 'domain_checks.status_code', 'domain_checks.created_at')
            ->distinct('domains.id')
            ->orderBy('domains.id')
            ->orderBy('domain_checks.updated_at', 'desc')
            ->get();
        return view('domain.index', compact('domains'));
    }
}
