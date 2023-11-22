<?php


use App\Http\Controllers\User\Account;
use App\Http\Controllers\User\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',[Dashboard::class,'landingPage'])
    ->name('user.dashboard');
/*======================== ACCOUNT ROUTE =====================*/
Route::get('account/index',[Account::class,'landingPage'])
    ->name('user.account');
Route::post('account/fund/main/escort',[Account::class,'processAccountFunding'])
    ->name('user.account.fund');
Route::post('account/convert/main/escort',[Account::class,'convertMainBalance'])
    ->name('user.account.convert');


