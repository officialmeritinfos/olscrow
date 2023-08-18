<?php


use App\Http\Controllers\User\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',[Dashboard::class,'landingPage'])
    ->name('user.dashboard');
