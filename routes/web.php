<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('login',[LoginController::class, 'login']);
Route::post('login',[LoginController::class, 'actLogin']);
Route::get('logout',[LoginController::class, 'logout']);
Route::middleware(['isLogin'])->group(function ()
{

    Route::get('/', function () {
        return view('index', ['title' => 'Dashboard']);
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
        Route::get('/add-manual', 'AddSPAToStagingController@index');
        Route::get('/add-manual/dt/{spa}', 'AddSPAToStagingController@getData');
        Route::get('/add-manual/insert/{spa}', 'AddSPAToStagingController@insert');
        Route::get('/update-io-manual', 'UpdateStagingController@index')->name('staging.updateStaging');
        Route::post('/update-io-manual/cari', 'UpdateStagingController@cari');
        Route::post('/update-io-manual/updatePTL', 'UpdateStagingController@updatePTL');
        Route::post('/update-io-manual/updateIO', 'UpdateStagingController@updateIO');
    });

    Route::prefix('pm2')->group(function () {
        Route::get('/send-pa-crm', 'PM2Controller@index');
        Route::post('/send-pa-crm/updateStatus', 'PM2Controller@updateStatus');
    });


    Route::prefix('sap')->group(function () {
        Route::get('/', 'SapController@index')->name('sap.index');
        Route::any('/cek/{io}', 'SapController@cek')->name('sap.cek');
        Route::get('/unlock', 'SapController@unlock')->name('sap.unlock');
        Route::get('/changePassword', 'SapController@changePassword')->name('sap.changePassword');
        Route::get('/stagingIo', 'SapController@stagingIo')->name('sap.stagingIo');
        Route::post('/stagingIo/cek', 'SapController@cekIoStaging')->name('sap.cekIoStaging');
        Route::post('/stagingIo/lemparSap', 'SapController@lemparSap')->name('sap.lemparSap');
        Route::get('/stagingIo/updateRequest/{io}', 'SapController@updateRequest')->name('sap.updateRequest');
        Route::post('/unlock/unlockUser', 'SapController@unlockUser')->name('sap.unlockUser');
        Route::post('/changePassword/changePasswordUser', 'SapController@changePasswordUser')->name('sap.changePasswordUser');
    });

    Route::prefix('iconpay')->group(function () {
        Route::get('/', 'IconPayController@index')->name('iconpay.index');
        Route::post('/cariIdPel','IconPayController@cariIdPel')->name('iconpay.cariIdPel');
        Route::post('/addPiutang','IconPayController@addPiutang')->name('iconpay.addPiutang');
        Route::get('/viewEditPiutang','IconPayController@viewEditPiutang')->name('iconpay.viewEditPiutang');
        Route::get('/viewBatalPiutang','IconPayController@viewBatalPiutang')->name('iconpay.viewBatalPiutang');
        Route::post('/editPiutang','IconPayController@editPiutang')->name('iconpay.editPiutang');
        Route::post('/batalPiutang','IconPayController@batalPiutang')->name('iconpay.batalPiutang');
        Route::post('/updateBatalPiutang','IconPayController@updateBatalPiutang')->name('iconpay.updateBatalPiutang ');
        // Route::post('/updateBillingCRM','IconPayController@updateBillingCRM')->name('iconpay.updateBillingCRM');
        Route::post('/saveLogIconPay','IconPayController@saveLogIconPay')->name('iconpay.saveLogIconPay');
    });
});


