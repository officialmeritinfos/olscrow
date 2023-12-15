<?php


use App\Http\Controllers\User\Account;
use App\Http\Controllers\User\Bookings;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\Dashboard;
use App\Http\Controllers\User\Hall;
use App\Http\Controllers\User\Orders;
use App\Http\Controllers\User\Profile;
use App\Http\Controllers\User\TransactionController;
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
Route::get('bookings/{id}/detail',[Bookings::class,'bookingDetail'])
    ->name('user.bookings.detail');
Route::post('bookings/accept/order',[Bookings::class,'acceptBooking'])
    ->name('user.booking.accept');
Route::post('bookings/request/transport',[Bookings::class,'requestTransportFee'])
    ->name('user.booking.request.transport');
Route::post('bookings/escort/mark-delivered',[Bookings::class,'escortMarkBookingDelivered'])
    ->name('user.booking.escort.markDelivered');
Route::post('bookings/escort/cancel-booking',[Bookings::class,'escortCancelBooking'])
    ->name('user.booking.escort.cancel');

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
    ->name('user.verification.submit');//submit profile verification
Route::get('profile/security/index',[Profile::class,'securitySetting'])
    ->name('user.security');
Route::post('profile/security/password',[Profile::class,'changePassword'])
    ->name('user.security.password');//change password
Route::post('profile/security/security',[Profile::class,'twoFactorAuth'])
    ->name('user.security.security');//update two-factor authentication
Route::get('profile/gallery/index',[Profile::class,'gallery'])
    ->name('user.gallery');
Route::post('profile/gallery/upload',[Profile::class,'processGalleryUpload'])
    ->name('user.gallery.upload');//upload photo
Route::get('profile/gallery/{id}/setProfile',[Profile::class,'setPhotoAsProfile'])
    ->name('user.gallery.setProfile');//set profile picture
Route::get('profile/gallery/{id}/delete',[Profile::class,'deleteAnImage'])
    ->name('user.gallery.delete');//delete
Route::get('profile/subscription/index',[Profile::class,'subscriptionManagement'])
    ->name('user.subscription');//subscription landing page
Route::post('profile/subscription/enroll',[Profile::class,'processSubscriptionEnrollment'])
    ->name('user.subscription.enroll');//enroll in subscription
Route::post('profile/subscription/cancel',[Profile::class,'cancelSubscription'])
    ->name('user.subscription.cancel');//cancel subscription
Route::post('profile/subscription/reactivate',[Profile::class,'reactivateSubscription'])
    ->name('user.subscription.reactivate');//reactivate subscription
Route::get('profile/addons/index',[Profile::class,'profileAddon'])
    ->name('user.addons');//addon landing page
Route::post('profile/addon/featured/enroll',[Profile::class,'enrollInFeatured'])
    ->name('user.addon.featured.enroll');//enroll in an addon
/*========================CHAT ROOM ROUTE ==============================================*/
Route::get('chats/index',[ChatController::class,'landingPage'])
    ->name('user.chats');
Route::get('chats/{id}/detail',[ChatController::class,'viewConversation'])
    ->name('user.chat.detail');
Route::get('chats/{id}/fetch',[ChatController::class,'fetchChat'])
    ->name('user.chat.content');
Route::post('chats/send-message',[ChatController::class,'sendMessage'])
    ->name('user.chat.sendMessage');
Route::post('chats/initiate-message',[ChatController::class,'initiateMessage'])
    ->name('user.chat.initiateMessage');
/*========================TRANSACTIONS ROUTE ==============================================*/
Route::get('transactions/index',[TransactionController::class,'landingPage'])
    ->name('user.transactions');
/*========================HALL ROUTE ==============================================*/
Route::get('hall/index',[Hall::class,'landingPage'])
    ->name('user.hall');
Route::get('hall/escort/{username}',[Hall::class,'escortDetail'])
    ->name('user.escort.detail');
Route::get('hall/escort/{username}/reviews',[Hall::class,'escortDetail'])
    ->name('user.escort.reviews');
Route::get('hall/escort/{username}/gallery',[Hall::class,'escortDetail'])
    ->name('user.escort.gallery');
//Booking
Route::get('booking/{package}/start',[Bookings::class,'startBookingProcess'])
    ->name('user.booking.start');
Route::post('booking/process-booking',[Bookings::class,'processBooking'])
    ->name('user.booking.process');

