<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

Route::get('/', function (Request $request) {
    return view('main');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home/{crawler_record_id}', [App\Http\Controllers\HomeController::class, 'showCrawlerRecord'])->name('home.showCrawlerRecord');
    Route::post('/home/delete/{crawler_record_id}', [App\Http\Controllers\HomeController::class, 'deleteCrawlerRecord'])->name('home.deleteCrawlerRecord');
});

