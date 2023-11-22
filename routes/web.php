<?php

use App\Http\Controllers\PushController;
use App\Http\Controllers\Webhooks\FlutterwaveTransactions;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::any('/push',[PushController::class,'store'])->name('push.store');

Route::get('/push/test',[PushController::class,'push'])->name('push');

/*======================== WEBHOOK ROUTE =====================*/
Route::post('webhook/transactions/flutterwave',[FlutterwaveTransactions::class,'landingPage']);
