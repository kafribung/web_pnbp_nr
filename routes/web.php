<?php

use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\StafKua\StafKua;
use App\Http\Livewire\Kua\Kua;
use App\Http\Livewire\Penghulu\Penghulu;
use App\Http\Livewire\Pernikahan\Pernikahan;
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
    Route::get('kua', Kua::class)->name('kua')->middleware('admin');
    Route::get('staf-kua', StafKua::class)->name('staf-kua');
    Route::get('penghulu', Penghulu::class)->name('penghulu');
    Route::get('pernikahan', Pernikahan::class)->name('pernikahan');
});

require __DIR__.'/auth.php';
