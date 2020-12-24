<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use DiDom\Document;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;

class DomainCheckController extends Controller
{
    private function checkDomain(string $domainName): array
    {
        $response = Http::get($domainName);
        $document = new Document($response->body());
        $domainData = [];
        $domainData['statusCode'] = $response->status();
        $domainData['h1'] = optional($document->first('h1'))->text();
        $domainData['keywords'] = optional($document->first('meta[name=keywords]'))->content;
        $domainData['description'] = optional($document->first('meta[name=description]'))->content;
        return $domainData;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->domain;
        $domainName = DB::table('domains')
            ->find($id)
            ->name;
        try {
            $domainData = $this->checkDomain($domainName);
        } catch (RequestException | ConnectionException $e) {
            Log::notice($e->getMessage());
            flash($e->getMessage())->error();
            return redirect()->route('domains.show', $id);
        }

        DB::table('domain_checks')->insert([
            'domain_id' => $id,
            'status_code' => $domainData['statusCode'],
            'h1' => $domainData['h1'],
            'keywords' => $domainData['keywords'],
            'description' => $domainData['description'],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        flash('Website has been checked!');
        return redirect()->route('domains.show', $id);
    }
}
