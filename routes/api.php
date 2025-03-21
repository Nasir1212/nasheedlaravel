<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NatteController;
use App\Http\Controllers\Api\LyricistController;
use App\Http\Controllers\Api\LoveController;
use App\Http\Controllers\Api\userAuthController;

// Routes that require authentication using Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // User logout route
    Route::controller(UserAuthController::class)->group(function () {    
        Route::post('/logout', 'logout');           
    });
    // Love system routes
    Route::controller(LoveController::class)->group(function () {
        Route::post('/nasheed/love', 'loveNasheed'); // Add love react
        Route::get('/nasheed/love/count/{nasheed_id}', 'countLoves'); // Count loves
        Route::post('/nasheed/love/remove', 'removeLove'); // Remove love
        Route::post('/nasheed/love/check', 'checkLove'); // Check love
    });

});

Route::controller(userAuthController::class)->group(function () {
    Route::post('/register', 'register');        
    Route::post('/login', 'login');        
        
  
});

Route::controller(NatteController::class)->group(function () {
    Route::get('/get_all_natte', 'getAllNatte');        
    Route::get('/get_one_natte/{id}', 'getOneNatte');        
    Route::get('/get_by_lyricist/{id}', 'getByLyricist');        
    Route::get('/fetchLyricsBySearch/{value}', 'fetchLyricsBySearch');        
    Route::get('/fetch_nasheed_link/{id}', 'fetch_nasheed_link');        
  
});
Route::controller(LyricistController::class)->group(function () {
    Route::get('/lyricist', 'Lyricist');        
    Route::get('/get_by_lyricist_id/{id}', 'get_by_lyricist_id');        
    Route::get('/fetchLyricistBySearch/{value}', 'fetchLyricistBySearch');        
    Route::get('/get_lyricist_by_id/{id}', 'get_lyricist_by_id');        
  
});




