<?php

use App\Http\Controllers\Staff\Bookings;
use App\Http\Controllers\Staff\Features;
use App\Http\Controllers\Staff\Home;
use App\Http\Controllers\Staff\Settings\Countries;
use App\Http\Controllers\Staff\Settings\Faqs;
use App\Http\Controllers\Staff\Settings\Fiats;
use App\Http\Controllers\Staff\Settings\GeneralSettings;
use App\Http\Controllers\Staff\Settings\Packages;
use App\Http\Controllers\Staff\Settings\Reports;
use App\Http\Controllers\Staff\Settings\Services;
use App\Http\Controllers\Staff\Transactions;
use App\Http\Controllers\Staff\Users;
use App\Http\Controllers\Staff\Verifications;
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

/*=================  TRANSACTIONS LISTS  ==================================*/
//Subscription
Route::get('transactions/subscriptions',[Transactions::class,'subscriptions'])
    ->name('transactions.subscriptions');
Route::get('transactions/subscription/{id}/detail',[Transactions::class,'subscriptionDetail'])
    ->name('transactions.subscription.detail');
//Addon
Route::get('transactions/addons',[Transactions::class,'addonPurchases'])
    ->name('transactions.addons');
Route::get('transactions/addon/{id}/detail',[Transactions::class,'addonPurchaseDetail'])
    ->name('transactions.addon.detail');
//account funding
Route::get('transactions/funding',[Transactions::class,'accountFunding'])
    ->name('transactions.funding');
Route::get('transactions/funding/{id}/detail',[Transactions::class,'accountFundingDetail'])
    ->name('transactions.funding.detail');
//withdrawals
Route::get('transactions/withdrawals',[Transactions::class,'withdrawals'])
    ->name('transactions.withdrawals');
Route::get('transactions/withdrawals/{id}/detail',[Transactions::class,'withdrawalDetail'])
    ->name('transactions.withdrawals.detail');

/*=================  VERIFICATIONS LISTS  ==================================*/
Route::get('verifications/completed',[Verifications::class,'completed'])
    ->name('verifications.completed');
Route::get('verifications/pending',[Verifications::class,'pending'])
    ->name('verifications.pending');
Route::get('verifications/{id}/detail',[Verifications::class,'verificationDetail'])
    ->name('verifications.detail');

/*=================  ESCORT FEATURES LISTS  ==================================*/
//packages
Route::get('features/packages',[Features::class,'packages'])
    ->name('features.packages');
//body features
Route::get('features/body-feature',[Features::class,'escortBodyFeature'])
    ->name('features.escort-body-feature');

/*=================  WEBSITE SETTING  ==================================*/
//General Settings
Route::get('settings/general-settings',[GeneralSettings::class,'landingPage'])
    ->name('settings.general-settings');
Route::post('settings/general-settings/update',[GeneralSettings::class,'processUpdate'])
    ->name('settings.general-settings.update');
//Country Settings
Route::get('settings/country',[Countries::class,'landingPage'])
    ->name('settings.country');
//Fiats
Route::get('settings/fiats',[Fiats::class,'landingPage'])
    ->name('settings.fiats');//landing page
//Faqs
Route::get('settings/faqs',[Faqs::class,'landingPage'])
    ->name('settings.faqs');//landing page
//Packages
Route::get('settings/packages',[Packages::class,'landingPage'])
    ->name('settings.packages');//landing page
Route::post('settings/packages/add',[Packages::class,'landingPage'])
    ->name('settings.packages.add');//add new
Route::get('settings/packages/edit',[Packages::class,'landingPage'])
    ->name('settings.packages.edit');//edit landing page
Route::post('settings/packages/update',[Packages::class,'landingPage'])
    ->name('settings.packages.update');//update
//Report Type
Route::get('settings/reports',[Reports::class,'landingPage'])
    ->name('settings.reports');//landing page
Route::post('settings/reports/add',[Reports::class,'landingPage'])
    ->name('settings.reports.add');//add new
Route::get('settings/reports/edit',[Reports::class,'landingPage'])
    ->name('settings.reports.edit');//edit landing page
Route::post('settings/reports/update',[Reports::class,'landingPage'])
    ->name('settings.reports.update');//update
//Services
Route::get('settings/services',[Services::class,'landingPage'])
    ->name('settings.services');//landing page
Route::post('settings/services/add',[Services::class,'landingPage'])
    ->name('settings.services.add');//add new
Route::get('settings/services/edit',[Services::class,'landingPage'])
    ->name('settings.services.edit');//edit landing page
Route::post('settings/services/update',[Services::class,'landingPage'])
    ->name('settings.services.update');//update
