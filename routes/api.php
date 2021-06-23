<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiTokenController;


/*****AUTH*****/
//Auth REGISTER
Route::post('auth/register', [ApiTokenController::class, 'register']);

//Auth LOGIN
Route::post('auth/login', [ApiTokenController::class, 'login']);
