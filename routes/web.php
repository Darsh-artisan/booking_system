<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;

// Room routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::post('/rooms/{room}/cost', [RoomController::class, 'calculateCost']);

// Booking routes
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/rooms/{roomId}/cost', [BookingController::class, 'calculateRoomCost'])->name('rooms.calculateCost');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

Route::get('/', function () {
    return view('welcome');
});


