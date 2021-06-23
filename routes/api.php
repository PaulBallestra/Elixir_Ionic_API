<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiTokenController;


/*****AUTH*****/
//REGISTER
Route::post('auth/register', [ApiTokenController::class, 'register']);

//LOGIN
Route::post('auth/login', [ApiTokenController::class, 'login']);

//LOGOUT
Route::middleware('auth:sanctum')->post('auth/logout', [ApiTokenController::class, 'logout']);
