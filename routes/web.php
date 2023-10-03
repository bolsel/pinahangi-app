<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth', 'verified'],
    'prefix' => '/app',
    'as' => 'app.'
], function () {
    Route::get('/', 'App\Http\Controllers\App\DashboardController@index')->name('index');
    Route::get('/pemberitahuan', 'App\Http\Controllers\App\UserController@pemberitahuan')->name('pemberitahuan');

    Route::group(['middleware' => 'can:permohonan.index'], function () {
        Route::get('/permohonan', [\App\Http\Controllers\App\PermohonanController::class, 'index'])->name('permohonan.index');
    });
    Route::group(['middleware' => 'can:permohonan.prosess'], function () {
        Route::get('/permohonan/proses', [\App\Http\Controllers\App\PermohonanController::class, 'prosesList'])->name('permohonan.proses-list');
        Route::get('/permohonan/proses/perbaiki', [\App\Http\Controllers\App\PermohonanController::class, 'perbaikiList'])->name('permohonan.perbaiki-list');
        Route::get('/permohonan/proses/{permohonan}', [\App\Http\Controllers\App\PermohonanController::class, 'proses'])->name('permohonan.proses');
    });
    Route::group(['middleware' => 'can:permohonan.telaah'], function () {
        Route::get('/permohonan/telaah', [\App\Http\Controllers\App\PermohonanController::class, 'telaahList'])->name('permohonan.telaah-list');
        Route::get('/permohonan/telaah/{permohonan}', [\App\Http\Controllers\App\PermohonanController::class, 'telaah'])->name('permohonan.telaah');
    });
    Route::group(['middleware' => 'can:su'], function () {
        Route::get('/organisasi', \App\Livewire\OrganisasiData::class)->name('organisasi.index');
        Route::get('/organisasi/form/{id?}', \App\Livewire\OrganisasiForm::class)->name('organisasi.form');
        Route::get('/organisasi/user', \App\Livewire\OrganisasiUser::class)->name('organisasi.user');
        Route::get('/organisasi/user/form/{id?}', \App\Livewire\OrganisasiUserForm::class)->name('organisasi.user.form');
        Route::get('/pemohon', \App\Livewire\PemohonData::class)->name('pemohon.index');
//        Route::get('/permohonan', [\App\Http\Controllers\App\PermohonanController::class, 'index'])->name('permohonan.index');
        Route::get('/permohonan/verifikasi', [\App\Http\Controllers\App\PermohonanController::class, 'verifikasiList'])->name('permohonan.verifikasi-list');
        Route::get('/permohonan/verifikasi/{permohonan}', [\App\Http\Controllers\App\PermohonanController::class, 'verifikasi'])->name('permohonan.verifikasi');
    });
    Route::group(['middleware' => 'can:roleIsOrganisasi'], function () {
//        Route::get('/permohonan', [\App\Http\Controllers\App\PermohonanController::class, 'index'])->name('permohonan.index');
        Route::get('/pemohon-identitas-update', \App\Livewire\PemohonUpdateIdentitas::class)->name('pemohon-identitas-update');
        Route::get('/permohonan-saya', [\App\Http\Controllers\App\PermohonanController::class, 'saya'])->name('permohonan-saya');
        Route::get('/permohonan-baru', \App\Livewire\PermohonanBaru::class)->name('permohonan-baru');
    });
    Route::group(['middleware' => 'can:roleIsUser'], function () {
        Route::get('/pemohon-identitas-update', \App\Livewire\PemohonUpdateIdentitas::class)->name('pemohon-identitas-update');
        Route::get('/permohonan-saya', [\App\Http\Controllers\App\PermohonanController::class, 'saya'])->name('permohonan-saya');
        Route::get('/permohonan-baru', \App\Livewire\PermohonanBaru::class)->name('permohonan-baru');
    });
});
