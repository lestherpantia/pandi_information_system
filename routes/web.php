<?php

use App\Http\Controllers\HouseHoldController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\UserController;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=> 'auth'], function() {

    /* Log out */
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::post('users/store', [UserController::class, 'store']);

    Route::get('/', [ResidenceController::class, 'index']);
    Route::get('residence/initial', [ResidenceController::class, 'initial']);
    Route::post('residence/store', [ResidenceController::class, 'store']);
    Route::get('residence/voters_pdf', [ResidenceController::class, 'pdf']);

    Route::get('household/getdata', [HouseHoldController::class, 'getdata']);
    Route::post('household/store', [HouseHoldController::class, 'store']);
    Route::get('household/household_pdf', [HouseHoldController::class, 'pdf']);
});


