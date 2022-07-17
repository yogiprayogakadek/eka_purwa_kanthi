<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Main\DashboardController@index')->name('main')->middleware('auth');
Route::prefix('/')->namespace('Main')->middleware('auth')->group(function(){
    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/', 'DashboardController@index')->name('index');
        // Route::post('/chart', 'DashboardController@chart')->name('chart');
    });

    Route::prefix('/anggota')->name('anggota.')->group(function(){
        Route::get('/', 'AnggotaController@index')->name('index');
        Route::get('/create', 'AnggotaController@create')->name('create');
        Route::get('/render', 'AnggotaController@render')->name('render');
        Route::post('/store', 'AnggotaController@store')->name('store');
        Route::get('/edit/{id}', 'AnggotaController@edit')->name('edit');
        Route::post('/update', 'AnggotaController@update')->name('update');
        Route::get('/print', 'AnggotaController@print')->name('print');
        Route::post('/change-status', 'AnggotaController@changeStatus')->name('change-status');
    });

    Route::prefix('/kandidat')->name('kandidat.')->group(function(){
        Route::get('/', 'KandidatController@index')->name('index');
        Route::get('/create', 'KandidatController@create')->name('create');
        Route::get('/render', 'KandidatController@render')->name('render');
        Route::post('/store', 'KandidatController@store')->name('store');
        Route::get('/edit/{id}', 'KandidatController@edit')->name('edit');
        Route::get('/detail-kandidat/{id_user}', 'KandidatController@detailKandidat')->name('detail-kandidat');
        Route::post('/update', 'KandidatController@update')->name('update');
        Route::get('/print', 'KandidatController@print')->name('print');
        Route::post('/change-status', 'KandidatController@changeStatus')->name('change-status');
    });

    Route::prefix('/anggota')->name('anggota.')->group(function(){
        Route::get('/', 'AnggotaController@index')->name('index');
        Route::get('/create', 'AnggotaController@create')->name('create');
        Route::get('/render', 'AnggotaController@render')->name('render');
        Route::post('/store', 'AnggotaController@store')->name('store');
        Route::get('/edit/{id}', 'AnggotaController@edit')->name('edit');
        Route::post('/update', 'AnggotaController@update')->name('update');
        Route::get('/print', 'AnggotaController@print')->name('print');
        Route::post('/change-status', 'AnggotaController@changeStatus')->name('change-status');
    });

    Route::prefix('/kegiatan')->name('kegiatan.')->group(function(){
        Route::get('/', 'KegiatanController@index')->name('index');
        Route::get('/create', 'KegiatanController@create')->name('create');
        Route::get('/render', 'KegiatanController@render')->name('render');
        Route::post('/store', 'KegiatanController@store')->name('store');
        Route::get('/edit/{id}', 'KegiatanController@edit')->name('edit');
        Route::post('/update', 'KegiatanController@update')->name('update');
        Route::get('/print', 'KegiatanController@print')->name('print');
        Route::post('/change-status', 'KegiatanController@changeStatus')->name('change-status');
    });

    Route::prefix('/pengumuman')->name('pengumuman.')->group(function(){
        Route::get('/', 'PengumumanController@index')->name('index');
        Route::get('/create', 'PengumumanController@create')->name('create');
        Route::get('/render', 'PengumumanController@render')->name('render');
        Route::post('/store', 'PengumumanController@store')->name('store');
        Route::get('/edit/{id}', 'PengumumanController@edit')->name('edit');
        Route::post('/update', 'PengumumanController@update')->name('update');
        Route::get('/print', 'PengumumanController@print')->name('print');
        Route::post('/change-status', 'PengumumanController@changeStatus')->name('change-status');
    });

    Route::prefix('/rapat')->name('rapat.')->group(function(){
        Route::get('/', 'RapatController@index')->name('index');
        Route::get('/create', 'RapatController@create')->name('create');
        Route::get('/render', 'RapatController@render')->name('render');
        Route::post('/store', 'RapatController@store')->name('store');
        Route::post('/notulen', 'RapatController@notulen')->name('notulen');
        Route::get('/edit/{id}', 'RapatController@edit')->name('edit');
        Route::post('/update', 'RapatController@update')->name('update');
        Route::get('/print', 'RapatController@print')->name('print');
        Route::post('/change-status', 'RapatController@changeStatus')->name('change-status');
        Route::get('/absen/{id_rapat}', 'RapatController@absensi')->name('absensi');
        Route::get('/detail-absensi/{id_rapat}', 'RapatController@detailAbsensi')->name('detail-absensi');
        Route::post('/proses-absensi', 'RapatController@prosesAbsensi')->name('proses-absensi');
    });

    Route::prefix('/keuangan')->name('keuangan.')->group(function(){
        Route::get('/', 'KeuanganController@index')->name('index');
        Route::get('/create', 'KeuanganController@create')->name('create');
        Route::get('/render', 'KeuanganController@render')->name('render');
        Route::post('/store', 'KeuanganController@store')->name('store');
        Route::get('/edit/{id}', 'KeuanganController@edit')->name('edit');
        Route::post('/update', 'KeuanganController@update')->name('update');
        Route::get('/print', 'KeuanganController@print')->name('print');
        Route::post('/change-status', 'KeuanganController@changeStatus')->name('change-status');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

