<?php

use App\Http\Controllers\Home\Home;
use App\Http\Controllers\PushController;
use App\Http\Controllers\Webhooks\FlutterwaveTransactions;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Home::class,'landingPage'])->name('home.index');
Route::get('about', [Home::class,'about'])->name('home.about');
Route::get('faqs', [Home::class,'faq'])->name('home.faq');
Route::get('how-it-works', [Home::class,'howItWorks'])->name('home.howItWorks');
Route::get('contact', [Home::class,'contact'])->name('home.contact');
Route::get('pricing', [Home::class,'pricing'])->name('home.pricing');
Route::get('escort-guide', [Home::class,'escortGuide'])->name('home.escort.guide');


Route::get('legal/reports',[Home::class,'reportTypes'])->name('legal.reports');
Route::get('legal/escort/terms',[Home::class,'escortTerm'])->name('legal.escort.terms');
Route::get('legal/client/terms',[Home::class,'clientTerms'])->name('legal.client.terms');
Route::get('legal/privacy',[Home::class,'privacyPolicy'])->name('legal.privacy');
Route::get('legal/community-guide',[Home::class,'communityGuide'])->name('legal.community-guide');
Route::get('legal/modern-day-slavery',[Home::class,'modernDaySlavery'])->name('legal.modern-day-slavery');

Route::any('/push',[PushController::class,'store'])->name('push.store');
Route::get('/push/test',[PushController::class,'push'])->name('push');

/*======================== WEBHOOK ROUTE =====================*/
Route::post('webhook/transactions/flutterwave',[FlutterwaveTransactions::class,'landingPage']);


