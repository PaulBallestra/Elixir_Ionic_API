<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\PostController;


/*****AUTH*****/
//REGISTER
Route::post('auth/register', [ApiTokenController::class, 'register']);

//LOGIN
Route::post('auth/login', [ApiTokenController::class, 'login']);

//LOGOUT
Route::middleware('auth:sanctum')->post('auth/logout', [ApiTokenController::class, 'logout']);

//ME
Route::middleware('auth:sanctum')->post('auth/me', [ApiTokenController::class, 'me']);

/*****POST*****/
Route::get('posts', [PostController::class, 'showAllPosts']);
