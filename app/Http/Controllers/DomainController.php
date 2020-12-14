<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    private function normalize(string $domain): string
    {
        $domainParsed = parse_url($domain);
        $scheme = mb_strtolower($domainParsed['scheme'] ?? null);
        $host = mb_strtolower($domainParsed['host'] ?? null);
        return "$scheme://$host";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->route('domains.show', ['domain' => $idOfDomain->implode('id')]);
        }

        $id = DB::table('domains')->insertGetId([
            'name' => $domain,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        flash('Url has been added');
        return redirect()->route('domains.show', ['domain' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $domain
     * @return \Illuminate\Http\Response
     */
    public function show($domain)
    {
        $domainData = DB::table('domains')
            ->where('id', $domain)
            ->get();
        if ($domainData->isEmpty()) {
            abort(404);
        }
        $domainChecks = DB::table('domain_checks')
            ->where('domain_id', $domain)
            ->orderBy('id', 'desc')
            ->get();
        return view('domain.show', ['domain' => $domainData[0], 'domainChecks' => $domainChecks]);
    }
}
