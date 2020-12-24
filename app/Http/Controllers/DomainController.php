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
            ->select('id', 'name')
            ->orderBy('id')
            ->get();
        $lastChecks = DB::table('domain_checks')
            ->select('domain_id', 'status_code', 'created_at')
            ->distinct('domain_id')
            ->orderBy('domain_id')
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy('domain_id')
            ->all();
        return view('domain.index', compact('domains', 'lastChecks'));
    }

    private function normalize(string $domain): string
    {
        $domainParsed = parse_url($domain);
        $scheme = mb_strtolower($domainParsed['scheme']);
        $host = mb_strtolower($domainParsed['host']);
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
            ->first();
        if (isset($idOfDomain)) {
            flash('Url already exists');
            return redirect()->route('domains.show', $idOfDomain->id);
        }

        $id = DB::table('domains')->insertGetId([
            'name' => $domain,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        flash('Url has been added');
        return redirect()->route('domains.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $domainData = DB::table('domains')
            ->find($id);
        if (empty($domainData)) {
            abort(404);
        }
        $domainChecks = DB::table('domain_checks')
            ->where('domain_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('domain.show', ['domain' => $domainData, 'domainChecks' => $domainChecks]);
    }
}
