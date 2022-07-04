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
    return view('index', ['title' => 'Dashboard']);
});

// Route::prefix('opportunity')->group(function () {
//     Route::get('/', 'OpportunityController@index')->name('r');
//     // Route::post('/getAll', 'OpportunityController@getAll')->name('data');
//     Route::any('/setData/{idpel}', 'OpportunityController@setData')->name('getData');
// });

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
    Route::post('/cari', 'SpaController@cari');
    Route::get('/getData/{idpel}', 'SpaController@getData');
    // Route::get('/{idpel}','SpaController@edit');
    Route::get('/update/{idpel}', 'SpaController@update');
    Route::get('/spaSync', 'SpaController@cek');
    Route::post('spaSync/cekStaging', 'SpaController@cekStaging');
    Route::get('spaSync/updateStatus/{no_spa}', 'SpaController@updateStatus');
});

Route::prefix('staging')->group(function () {
    Route::get('/', 'StagingController@index')->name('staging.index');
    Route::post('/cari', 'StagingController@cari')->name('staging.cari');
    Route::get('/getPA/{no_pa}', 'StagingController@getData');
    Route::post('/update', 'StagingController@update')->name('staging.updatePA');
    Route::get('/cekCrm/{no_pa}', 'StagingController@cekCrm')->name('staging.cekCrm');
    Route::post('/insertData', 'StagingController@insertData')->name('staging.insertData');
});

Route::prefix('pm2')->group(function () {
    Route::get('/send-pa-crm', 'PM2Controller@index');
});


