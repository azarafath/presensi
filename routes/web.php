<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Presensi;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/presensi', Presensi::class)->name('presensi');
});
// Route Login Filament /admin
Route::get('/login', function () {
    return redirect(route('filament.admin.auth.login'));
})->name('login');