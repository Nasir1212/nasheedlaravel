<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studio\studioController;
use App\Http\Controllers\studio\studioAuthController;
use App\Http\Controllers\studio\ProfileController;
use App\Http\Middleware\AuthenticateStudio;
Route::get('/', function () {
    return view('welcome');
});

//Studion Route 
Route::prefix('studio')->name('studio.')->group(function () {
 Route::group(['middleware' => [AuthenticateStudio::class]], function () {


Route::controller(studioController::class)->group(function () {
    
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/my_nasheed', 'my_nasheed')->name('my_nasheed');
    Route::get('/add_nasheed', 'add_nasheed')->name('add_nasheed');
    Route::post('/store_nasheed', 'store_nasheed')->name('store_nasheed');
    Route::get('/edit_nasheed/{id}', 'edit_nasheed')->name('edit_nasheed');
    Route::post('update_nasheed', 'update_nasheed')->name('update_nasheed');
    Route::get('delete_nasheed/{id}', 'delete_nasheed')->name('delete_nasheed');
    Route::get('show_nasheed/{id}', 'show_nasheed')->name('show_nasheed');
    Route::get('add_vido_link', 'add_vido_link')->name('add_vido_link');
    Route::post('delete_video', 'delete_video')->name('delete_video');


});
 });
Route::controller(studioAuthController::class)->group(function () {
    Route::post('login', 'login_studio')->name('login_studio');
    Route::get('logout', 'logout')->name('logout');
    Route::get('login', 'login')->name('login');
    Route::get('signup', 'signup')->name('signup');
    Route::post('signup_studio', 'signup_studio')->name('signup_studio');
    
});
Route::controller(ProfileController::class)->group(function () {
    Route::get('profile', 'profile')->name('profile');
    Route::get('edit_profile', 'edit_profile')->name('edit_profile');
    Route::post('update_profile', 'update_profile')->name('update_profile');
  
    
});




// Route::get('/dashboard', function () {
//     return view('pages.studio.dashboard');
// });
// Route::get('/login', function () {
//     return view('pages.studio.login');
// })->name('login');
// Route::get('/signup', function () {
//     return view('pages.studio.signup');
// })->name('signup');

});

Route::get('/share/{nasheed_id}/{nasheed_name}', function ($nasheed_id,$nasheed_name, Request $request) {
    $app_scheme = 'nasheedhub://nasheed/' . $nasheed_id;
    $web_url = url('/nasheed/' . $nasheed_id);

    return view('redirect', compact('app_scheme', 'web_url'));
});