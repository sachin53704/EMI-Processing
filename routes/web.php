<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProcessDataController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmiDetailsController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'postLogin'])->name('post-login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('process-data', [ProcessDataController::class, 'processData'])->name('process-data');

    Route::get('/emi-details', [EmiDetailsController::class, 'index'])->name('emi-details.index');
    Route::post('/emi-details/process', [EmiDetailsController::class, 'process'])->name('emi-details.process');
});
