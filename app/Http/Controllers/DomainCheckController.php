<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use DiDom\Document;


class DomainCheckController extends Controller
{
    private function checkDomain(string $domainName): array
    {
        $response = Http::get($domainName);
        $document = new Document($response->body());
        $domainData = [];
        $domainData['statusCode'] = $response->status();
        $domainData['h1'] = $document->has('h1') ? $document->first('h1')->text() : null;
        $domainData['keywords'] = optional($document->first('meta[name=keywords]'))->content;
        $domainData['description'] = optional($document->first('meta[name=description]'))->content;
        return $domainData;
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $domainName = DB::table('domains')
            ->select('name')
            ->where('id', $id)
            ->first()
            ->name;
        try {
            $domainData = $this->checkDomain($domainName);
        } catch (\Exception $e) {
            Log::notice("Domain checking error. Id of domain is $id");
            return redirect()->route('domains.show', ['id' => $id])
                ->with('warning', 'Something was wrong');
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
        return redirect()->route('domains.show', ['id' => $id])
            ->with('success', 'Website has been checked!');
    }
}
