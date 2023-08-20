<?php

use Illuminate\Support\Facades\Route;
use Http\Controllers;
use App\Http\Controllers\FlightContoller;
use App\Http\Middleware\Flight;

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

// Route::get('/', function () {
//     return view('welcome');
// });
 Route::get('/', [FlightContoller::class, 'home']);
 Route::get('flights', [FlightContoller::class, 'flightsview']);
 Route::post('flights', [FlightContoller::class, 'flights'])->name('flight.search');
 Route::post('swap/post', [FlightContoller::class, 'swap'])->name('swap.post');
 Route::post('swap/delete/{id}', [FlightContoller::class, 'delete'])->name('swap.delete');