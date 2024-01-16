<?php

use App\Http\Controllers\Admin\Home;
use Illuminate\Support\Facades\Route;


Route::get('dashboard',[Home::class,'landingPage'])
    ->name('staff.dashboard');
Route::post('dashboard/setPin',[Home::class,'setPin'])
    ->name('staff.dashboard.setPin');