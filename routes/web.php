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

Route::get('/', function () {
    return view('index', ['title'=>'Dashboard']);
});

Route::prefix('opportunity')->group(function () {
    Route::get('/', 'OpportunityController@index')->name('r');
    Route::post('/', 'OpportunityController@cari');
    Route::get('/cari', 'OpportunityController@cari');
});

Route::prefix('antrian')->group(function () {
    Route::get('/', 'AntrianController@index')->name('s');
    Route::post('/', 'AntrianController@cari');
    Route::get('/{idpel}', 'AntrianController@getData');
});

Route::prefix('spa')->group(function () {
    Route::get('/', 'SpaController@index')->name('t');
    Route::post('/', 'SpaController@cari');
    Route::get('/{idpel}', 'SpaController@getData');
});
