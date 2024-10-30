<?php

use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [DestinationController::class, 'search'])->name('search');

// Route::get('/', [HotelController::class, 'search'])->name('hotel.search');
Route::get('/', [TourController::class, 'search'])->name('tour.search');
Route::get('/destination', [DestinationController::class, 'search'])->name('destination.search');

Route::resource('tours', TourController::class);
Route::resource('hotels', HotelController::class);
Route::resource('hotels.rooms', RoomController::class);
Route::resource('bookings', BookingController::class);