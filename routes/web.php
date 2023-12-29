<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UrlShortenerController;
use App\Models\UrlShortener;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use nazmulhossain\HelloWord\Hello;
use NahidHasanLimon\GradeCalculator\Calculator;
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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/url/shortener', [UrlShortenerController::class, 'url_shortener'])->name('shortener');
    Route::post('/url/shortener', [UrlShortenerController::class, 'url_shortener_store'])->name('shortener.store');
    Route::get('/url/redirect', [UrlShortenerController::class, 'url_redirect'])->name('url.redirect');
    
});
require __DIR__.'/auth.php';
