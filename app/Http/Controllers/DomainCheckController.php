<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomainCheckController extends Controller
{
    public function store(Request $request)
    {
        $id = $request->id;
        DB::table('domain_checks')->insert([
            'domain_id' => $id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        return redirect()->route('domains.show', ['id' => $id])
            ->with('status', 'Website has been checked!');
    }
}
