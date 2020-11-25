<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\DomainController@create')
    ->name('domains.create');
Route::post('/', 'App\Http\Controllers\DomainController@store')
    ->name('domains.store');
Route::get('/domains/{id}', 'App\Http\Controllers\DomainController@show')
    ->name('domains.show');
Route::get('/domains', 'App\Http\Controllers\DomainController@index')
    ->name('domains.index');
Route::post('domains/{id}/checks', 'App\Http\Controllers\DomainCheckController@store')
    ->name('domains.checks.store');
