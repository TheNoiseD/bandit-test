<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get('/', [ActivitiesController::class,'home'])->name('home');
Route::get('/activities/search', [ActivitiesController::class,'ajaxSearch'])->name('activities.search');
Route::resource('reserve', BookingController::class)->only(['index','store'])->middleware('auth');
Route::resource('activities', ActivitiesController::class);
Auth::routes();
