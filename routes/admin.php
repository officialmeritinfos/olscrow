<?php

use App\Http\Controllers\Admin\Home;
use Illuminate\Support\Facades\Route;


Route::get('staff/dashboard',[Home::class,'landingPage'])
    ->name('staff.dashboard');
Route::post('staff/dashboard/setPin',[Home::class,'setPin'])
    ->name('staff.dashboard.setPin');
