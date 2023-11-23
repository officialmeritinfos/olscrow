<?php


use App\Http\Controllers\User\Account;
use App\Http\Controllers\User\Bookings;
use App\Http\Controllers\User\Dashboard;
use App\Http\Controllers\User\Orders;
use App\Http\Controllers\User\Profile;
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
/*======================== ORDER ROUTE =====================*/
Route::get('orders/index',[Orders::class,'landingPage'])
    ->name('user.orders');
Route::post('orders/create/new',[Orders::class,'processOrderCreation'])
    ->name('user.orders.create');
Route::get('orders/{id}/edit',[Orders::class,'editOrder'])
    ->name('user.orders.edit');
Route::post('orders/delete',[Orders::class,'deleteOrder'])
    ->name('user.orders.delete');
Route::post('orders/update',[Orders::class,'updateOrder'])
    ->name('user.orders.update');
/*======================== BOOKING ROUTE =====================*/
Route::get('bookings/index',[Bookings::class,'landingPage'])
    ->name('user.bookings');


/*======================== PROFILE ROUTE =====================*/
Route::get('profile/index',[Profile::class,'landingPage'])
    ->name('user.profile');
Route::get('profile/public/index',[Profile::class,'publicProfile'])
    ->name('user.profile.public');
Route::post('profile/public/set',[Profile::class,'setPublicProfile'])
    ->name('user.profile.public.set');//setup profile
Route::get('profile/location/index',[Profile::class,'profileLocation'])
    ->name('user.profile.location');
Route::post('profile/location/set',[Profile::class,'processLocationUpdate'])
    ->name('user.profile.location.set');//update location
Route::get('fetch/country_states',[Profile::class,'fetchCountryStates'])
    ->name('user.fetch_country_states');
Route::get('fetch/state_city',[Profile::class,'fetchStateCity'])
    ->name('user.fetch_state_city');
Route::get('profile/verification/index',[Profile::class,'escortVerification'])
    ->name('user.verification');
Route::post('profile/verification/submit',[Profile::class,'processEscortVerification'])
    ->name('user.verification.submit');
