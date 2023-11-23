<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::any('/push',[PushController::class,'store'])->name('push.store');
Route::get('/push/test',[PushController::class,'push'])->name('push');

/*======================== WEBHOOK ROUTE =====================*/
Route::post('webhook/transactions/flutterwave',[FlutterwaveTransactions::class,'landingPage']);

Route::get('testWatermark',function (){
    $web = \App\Models\GeneralSetting::find(1);
    $user = \Illuminate\Support\Facades\Auth::user();

    $verification = \App\Models\EscortVerification::where('user',$user->id)->first();

    $img = Image::make(public_path('dashboard/images/cover-img.jpg'));
    // Watermark text and settings
    $watermarkText = env('APP_URL');
    $fontSize = 40;
    $angle = 20; // Rotation angle for diagonal placement
    // write text
    $img->text($watermarkText, $img->width() / 2, $img->height() / 2, function ($font) use ($fontSize, $angle) {
        $font->file(public_path('dashboard/fonts/times new roman bold.ttf')); // Specify the path to your font file
        $font->size($fontSize);
        $font->color([255, 255, 255, 0.5]); // RGBA color for the watermark
        $font->align('center');
        $font->valign('center');
        $font->angle($angle); // Set the rotation angle
    });
//    $img->insert(public_path($web->logo), 'center');
    $img->save(public_path('dashboard/images/cover-imgs.jpg'));
});

Route::get('escort/{username}')->name('escort.page');
