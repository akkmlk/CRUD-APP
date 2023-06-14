<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatihanController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return "Oops! Kamu Lupa Mengetikkan ' latihan ' setelah ' / ' Pada URL Kamu Diatas";
});

Route::resource('latihan', LatihanController::class);
