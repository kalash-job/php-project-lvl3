<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class DomainCheckController extends Controller
{
    private function checkDomain(string $domainName): int
    {
        $response = Http::get($domainName);
        return $response->status();
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
            $statusCode = $this->checkDomain($domainName);
        } catch (\Exception $e) {
            Log::notice("Domain checking error. Id of domain is $id");
            return redirect()->route('domains.show', ['id' => $id])
                ->with('warning', 'Something was wrong');
        }

        DB::table('domain_checks')->insert([
            'domain_id' => $id,
            'status_code' => $statusCode,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect()->route('domains.show', ['id' => $id])
            ->with('success', 'Website has been checked!');
    }
}
