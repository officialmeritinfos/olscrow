<?php

use App\Http\Controllers\Staff\Bookings;
use App\Http\Controllers\Staff\Home;
use App\Http\Controllers\Staff\Users;
use Illuminate\Support\Facades\Route;


Route::get('dashboard',[Home::class,'landingPage'])
    ->name('dashboard');
Route::post('dashboard/setPin',[Home::class,'setPin'])
    ->name('dashboard.setPin');

/*=================  USER LISTS  ==================================*/
Route::get('users/escorts',[Users::class,'escorts'])
    ->name('users.escorts');
Route::get('users/escort/{id}/details',[Users::class,'escortDetails'])
    ->name('user.escort.details');
Route::get('users/clients',[Users::class,'clients'])
    ->name('users.clients');
Route::get('users/client/{id}/details',[Users::class,'clientDetails'])
    ->name('user.client.details');

/*=================  BOOKING LISTS  ==================================*/
Route::get('bookings/ongoing',[Bookings::class,'ongoingBookings'])
    ->name('bookings.ongoing');
Route::get('bookings/completed',[Bookings::class,'completedBookings'])
    ->name('bookings.completed');
Route::get('bookings/pending',[Bookings::class,'pendingBookings'])
    ->name('bookings.pending');
Route::get('bookings/reported',[Bookings::class,'reportedBookings'])
    ->name('bookings.reported');
Route::get('bookings/{id}/detail',[Bookings::class,'bookingDetail'])
    ->name('bookings.detail');
