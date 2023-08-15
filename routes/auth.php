<?php


use App\Http\Controllers\Auth\Register;
use Illuminate\Support\Facades\Route;

/*
 *  AUTHENTICATION ROUTE
 */
Route::get('register',[Register::class,'landingPage'])->name('auth.register');
