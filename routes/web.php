<?php

use App\Http\Controllers\{PrintController, PrintKuaController};
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\JasaProfesiDanTransport\JasaProfesiDanTransport;
use App\Http\Livewire\StafKua\StafKua;
use App\Http\Livewire\Kua\Kua;
use App\Http\Livewire\Penghulu\Penghulu;
use App\Http\Livewire\Pernikahan\Pernikahan;
use App\Http\Livewire\Profil\Profil;
use App\Http\Livewire\RekapPnbpNr\RekapPnbpNr;
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
    return redirect('dashboard');
});

Route::middleware('auth')->group(function() {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::middleware('admin')->group(function () {
        Route::get('kua', Kua::class)->name('kua');
        Route::get('staf-kua', StafKua::class)->name('staf-kua');
        Route::get('penghulu', Penghulu::class)->name('penghulu');
        Route::get('print/kua/{currentMonth}/{currentYear}', PrintKuaController::class)->name('print-kua');
    });

    Route::get('pernikahan', Pernikahan::class)->name('pernikahan');
    Route::get('jasa-profesi-dan-transport', JasaProfesiDanTransport::class)->name('jasa-profesi-dan-transport');
    Route::get('rekap-pnbp-nr', RekapPnbpNr::class)->name('rekap-pnbp-nr');
    Route::get('print/{currentMonth}/{currentYear}/{filterKua}', PrintController::class)->name('print');
    Route::get('profil', Profil::class)->name('profil');
});

require __DIR__.'/auth.php';
