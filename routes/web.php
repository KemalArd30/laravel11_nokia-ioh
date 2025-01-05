<?php

use App\Http\Controllers\AbdController;
use App\Http\Controllers\AcceptanceController;
use App\Http\Controllers\AtpController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoqController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileNamingController;
use App\Http\Controllers\ImplementasiController;
use App\Http\Controllers\LldNdbController;
use App\Http\Controllers\NetgearAtfController;
use App\Http\Controllers\NetgearMosController;
use App\Http\Controllers\PbiWccController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SidController;
use App\Http\Controllers\SitelistController;
use App\Http\Controllers\SummaryAtpController;
use App\Http\Controllers\SummaryTssController;
use App\Http\Controllers\TssController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\WccFullPaymentController;
use App\Http\Controllers\WccFullPaymentDataController;
use App\Models\NetgearAtf;
use App\Models\NetgearMos;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route untuk halaman welcome
Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // route untuk Users
    Route::resource('users', UserManagementController::class);
    Route::get('/users/data', [UserManagementController::class, 'getData'])->name('users.data');
    Route::post('/users/bulk-delete', [UserManagementController::class, 'bulkDelete'])->name('users.bulk-delete');

    // route untuk Region
    Route::resource('region', RegionController::class);
    Route::get('/regions/data', [RegionController::class, 'getData'])->name('regions.data');
    Route::delete('/regions/bulk-delete', [RegionController::class, 'bulkDelete'])->name('regions.bulk-delete');

    // route untuk Sitelist
    Route::resource('sitelist', SitelistController::class);
    Route::post('/sitelist/bulk-delete', [SitelistController::class, 'bulkDelete'])->name('sitelist.bulk-delete');
    Route::get('/sitelist/data', [SitelistController::class, 'getData'])->name('sitelist.data');

    // route untuk FileNaming
    Route::resource('filenaming', FileNamingController::class);

    // Route Import
    Route::post('/sitelist/import', [SitelistController::class, 'import'])->name('sitelist.import');
    Route::post('/filenaming/import', [FileNamingController::class, 'import'])->name('filenaming.import');
    Route::post('/tss/import', [TssController::class, 'import'])->name('tss.import');
    Route::get('/implementasi/create', [ImplementasiController::class, 'create'])->name('implementasi.create');
    Route::post('/implementasi/import', [ImplementasiController::class, 'import'])->name('implementasi.import');
    Route::post('/wcc/import-full-payment', [PbiWccController::class, 'importFullPay'])->name('wcc.import-full-payment');
    Route::post('/wcc/import-partial-payment', [PbiWccController::class, 'importPartialPay'])->name('wcc.import-partial-payment');

    // Resource route untuk PBI WCC
    Route::resource('pbiWcc', PbiWccController::class);

});

// Rute untuk user yang bisa mengedit
Route::middleware(['auth', 'role:admin|user'])->group(function () {

    // route Edit/Update TSS
    Route::get('tss/{id_tss}/edit', [TssController::class, 'edit'])->name('tss.edit');
    Route::post('tss/{id_tss}/update', [TssController::class, 'update'])->name('tss.update');

    // route Edit/Update SID
    Route::get('sid/{id_tss}/edit', [SidController::class, 'edit'])->name('sid.edit');
    Route::post('sid/{id_tss}/update', [SidController::class, 'update'])->name('sid.update');

    // route Edit/Update OnAir
    Route::get('implementasi/{id_implementasi}/edit', [ImplementasiController::class, 'edit'])->name('implementasi.edit');
    Route::post('implementasi/{id_implementasi}/update', [ImplementasiController::class, 'update'])->name('implementasi.update');

    // route Edit/Update NETGear MOS
    Route::get('netgearMos/{id_implementasi}/edit', [NetgearMosController::class, 'edit'])->name('netgearMos.edit');
    Route::post('netgearMos/{id_implementasi}/update', [NetgearMosController::class, 'update'])->name('netgearMos.update');

    // route Edit/Update LLD / NDB
    Route::get('lldNdb/{id_implementasi}/edit', [LldNdbController::class, 'edit'])->name('lldNdb.edit');
    Route::post('lldNdb/{id_implementasi}/update', [LldNdbController::class, 'update'])->name('lldNdb.update');

    // route Edit/Update ABD
    Route::get('abd/{id_implementasi}/edit', [AbdController::class, 'edit'])->name('abd.edit');
    Route::post('abd/{id_implementasi}/update', [AbdController::class, 'update'])->name('abd.update');

    // route Edit/Update BOQ
    Route::get('boq/{id_implementasi}/edit', [BoqController::class, 'edit'])->name('boq.edit');
    Route::post('boq/{id_implementasi}/update', [BoqController::class, 'update'])->name('boq.update');
    
    // route Edit/Update ATF
    Route::get('atf/{id_implementasi}/edit', [NetgearAtfController::class, 'edit'])->name('atf.edit');
    Route::post('atf/{id_implementasi}/update', [NetgearAtfController::class, 'update'])->name('atf.update');

    // route Edit/Update ATP
    Route::get('atp/{id_implementasi}/edit', [AtpController::class, 'edit'])->name('atp.edit');
    Route::post('atp/{id_implementasi}/update', [AtpController::class, 'update'])->name('atp.update');

    // route Edit/Update Acceptance
    Route::get('acceptance/{id_implementasi}/edit', [AcceptanceController::class, 'edit'])->name('acceptance.edit');
    Route::post('acceptance/{id_implementasi}/update', [AcceptanceController::class, 'update'])->name('acceptance.update');
});


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('layouts.app');
    })->name('home');

    // route View Sitelist
    Route::get('/sitelist', [SitelistController::class, 'index'])->name('sitelist.index');

    // route View Filenaming
    Route::get('/filenaming', [FileNamingController::class, 'index'])->name('filenaming.index');

    // route View TSS
    Route::get('/tss', [TssController::class, 'index'])->name('tss.index');

    // route View SID
    Route::get('/sid', [SidController::class, 'index'])->name('sid.index');

    // route View Implementasi
    Route::get('/implementasi', [ImplementasiController::class, 'index'])->name('implementasi.index');

    // route View NETGear MOS
    Route::get('/netgearMos', [NetgearMosController::class, 'index'])->name('netgearMos.index');

    // route View LLD / NDB
    Route::get('/lldNdb', [LldNdbController::class, 'index'])->name('lldNdb.index');

    // route View ABD
    Route::get('/abd', [AbdController::class, 'index'])->name('abd.index');

    // route View BOQ
    Route::get('/boq', [BoqController::class, 'index'])->name('boq.index');

    // route View ATF
    Route::get('/atf', [NetgearAtfController::class, 'index'])->name('atf.index');

    // route View ATP
    Route::get('/atp', [AtpController::class, 'index'])->name('atp.index');

    // route View ATP
    Route::get('/acceptance', [AcceptanceController::class, 'index'])->name('acceptance.index');

    // route View WCC Full Payment
    Route::get('/wccFullPayment', [WccFullPaymentController::class, 'index'])->name('wccFullPayment.index');

    // Route View Dashboard
    Route::get('/summary', [DashboardController::class, 'index'])->name('summary');
    Route::get('/summaryTss', [SummaryTssController::class, 'index'])->name('summaryTss');
    Route::get('/summaryAtp', [SummaryAtpController::class, 'index'])->name('summaryAtp');

    // Route Export
    Route::get('/export-regionlist', [RegionController::class, 'export'])->name('regionlist.export');
    Route::get('/export-sitelist', [SiteListController::class, 'export'])->name('sitelist.export');
    Route::get('/export-filenaming', [FileNamingController::class, 'export'])->name('filenaming.export');
    Route::get('/export-tss', [TssController::class, 'export'])->name('tss.export');
    Route::get('/export-sid', [SidController::class, 'export'])->name('sid.export');
    Route::get('/export-acceptance', [AcceptanceController::class, 'export'])->name('acceptance.export');

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update-name', [UserController::class, 'updateName'])->name('profile.updateName');
    Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->name('profile.updatePassword');

});

// Rute Login - Logout
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);