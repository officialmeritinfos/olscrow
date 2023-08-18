<?php


use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\RecoverAccount;
use App\Http\Controllers\Auth\Register;
use Illuminate\Support\Facades\Route;

/*
 *  AUTHENTICATION ROUTE
 */

/*========== ACCOUNT CREATION ======================*/
Route::get('register',[Register::class,'landingPage'])
    ->name('register');
Route::post('register/process',[Register::class,'processRegistration'])
    ->name('auth.register');


/*========== ACCOUNT LOGIN ======================*/
Route::get('login',[Login::class,'landingPage'])
    ->name('login');
Route::post('login/process',[Login::class,'processLogin'])
    ->name('auth.login');

/*========== ACCOUNT RECOVERY ======================*/
Route::get('recover-password',[RecoverAccount::class,'landingPage'])
    ->name('recoverPassword');
Route::post('recover-password/process',[RecoverAccount::class,'processPasswordRecovery'])
    ->name('auth.recover');

//Middleware routes
Route::middleware(['web','auth'])->group(function (){
    //Email verification
    Route::get('register/email-verification',[Register::class,'emailVerification'])
        ->name('email-verification');
    Route::post('register/email-verification/process',[Register::class,'processEmailVerification'])
        ->name('auth.email');

    //Two-factor authentication
    Route::get('login/login-verification',[Login::class,'twoFactorAuthentication'])
        ->name('login-verification');
    Route::post('login/login-verification/process',[Login::class,'processTwoFactor'])
        ->name('auth.twoFactor');

    //Password Reset authentication
    Route::get('recover-password/email-verification',[RecoverAccount::class,'requestVerificationPage'])
        ->name('verify-password-reset');
    Route::post('recover-password/email-verification/process',[RecoverAccount::class,'processVerificationCode'])
        ->name('auth.recovery');
});
