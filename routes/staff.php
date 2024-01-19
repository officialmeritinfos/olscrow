<?php

use App\Http\Controllers\Staff\Home;
use App\Http\Controllers\Staff\Users;
use Illuminate\Support\Facades\Route;


Route::get('dashboard',[Home::class,'landingPage'])
    ->name('staff.dashboard');
Route::post('dashboard/setPin',[Home::class,'setPin'])
    ->name('staff.dashboard.setPin');

/*=================  USER LISTS  ==================================*/
Route::get('users/escorts',[Users::class,'escorts'])
    ->name('staff.users.escorts');
Route::get('users/escort/{id}/details',[Users::class,'escortDetails'])
    ->name('staff.user.escort.details');
Route::get('users/clients',[Users::class,'clients'])
    ->name('staff.users.clients');
Route::get('users/client/{id}/details',[Users::class,'clientDetails'])
    ->name('staff.user.client.details');
