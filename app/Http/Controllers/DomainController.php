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

    public function normalize(string $domain): string
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
            return redirect()->route('domains.show', ['id' => $idOfDomain->implode('id')])
                ->with('status', 'Url already exists');
        }

        $id = DB::table('domains')->insertGetId([
            'name' => $domain,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect()->route('domains.show', ['id' => $id])
            ->with('status', 'Url has been added');
    }

    public function show($id)
    {
        $domain = DB::table('domains')
            ->where('id', $id)
            ->get();
        if ($domain->isEmpty()) {
            abort(404);
        }
        return view('domain.show', ['domain' => $domain[0]]);
    }

    public function index()
    {
        $domains = DB::table('domains')->get();
        return view('domain.index', compact('domains'));
    }
}
