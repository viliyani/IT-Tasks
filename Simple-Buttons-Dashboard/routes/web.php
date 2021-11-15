<?php

use App\Http\Controllers\ButtonController;
use App\Http\Controllers\DashboardController;
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

// Patterns
Route::pattern('position', '\d+');

// Endpoints

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Edit Button's Data
    Route::get('/buttons/{position}/edit', [ButtonController::class, 'edit'])->name('buttons.edit');
    Route::put('/buttons/{position}', [ButtonController::class, 'update'])->name('buttons.update');

    // Delete Button's Data
    Route::delete('/buttons/{position}', [ButtonController::class, 'destroy'])->name('buttons.destroy');

});

require __DIR__.'/auth.php';
