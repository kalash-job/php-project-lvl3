<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\DomainCheckController;

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

Route::get('/', [DomainController::class, 'create'])
    ->name('home');

Route::resource('domains', DomainController::class)->except([
    'update', 'destroy', 'edit'
]);
Route::post('domains/{id}/checks', [DomainCheckController::class, 'store'])
    ->name('domains.checks.store');
