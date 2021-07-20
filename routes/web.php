<?php

use App\Http\Livewire\Dashboard\Dashboard;
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

Route::middleware('auth')->group(function (){
    Route::middleware('role:admin')->group(function (){
        Route::get('staf-kua', fn() => 'staf kua');
    });
    Route::middleware('role:admin|kalukku')->group(function (){
        Route::get('dashboard', Dashboard::class)->name('dashboard');
    });
});

require __DIR__.'/auth.php';
