<?php

use App\Http\Controllers\backend;
use App\Http\Controllers\tenderEngine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use AfricasTalking\SDK\AfricasTalking;

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
    return redirect('/login');
});
Route::get('/tender', function () {
    return view('layouts.dashboard');
});
Route::get('/supply', function () {
    return view('layouts.supply');
});
Route::post('/trainpredictor', [tenderEngine::class, 'trainPredictor']);
Route::post('/winner', [tenderEngine::class, 'declareWinner']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/handletender', [App\Http\Controllers\backend::class, 'handletender'])->name('tender');



Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
});


//admin routes

Route::get('/post_tender', [App\Http\Controllers\backend::class, 'postTender'])->middleware('auth');
Route::post('/post_tender', [App\Http\Controllers\backend::class, 'addTender'])->middleware('auth');
Route::get('/female', [App\Http\Controllers\backend::class, 'femaleReport'])->middleware('auth');
Route::post('/settings', [App\Http\Controllers\backend::class, 'settings'])->middleware('auth');

