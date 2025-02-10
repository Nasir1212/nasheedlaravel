<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NatteController;
use App\Http\Controllers\Api\LyricistController;
use App\Http\Controllers\Api\LoveController;


Route::get('/user', function (Request $request) {
    return $request->user();
});

// ->middleware('auth:sanctum');

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
  
});

Route::controller(LoveController::class)->group(function () {
    Route::post('/nasheed/love', 'loveNasheed'); // Add love react
    Route::get('/nasheed/love/count/{nasheed_id}', 'countLoves'); // Count loves
    Route::post('/nasheed/love/remove', 'removeLove'); // Remove love
    Route::post('/nasheed/love/check', 'checkLove'); // Remove love
});




