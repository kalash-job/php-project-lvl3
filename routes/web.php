<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\DomainCheckController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $domain = ['name' => ''];
    return view('home.index', compact('domain'));
})->name('index');

Route::resource('domains', DomainController::class)->except([
    'update', 'destroy', 'edit'
]);

Route::resource('domains.checks', DomainCheckController::class)->only(['store']);
