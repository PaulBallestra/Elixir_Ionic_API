<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PlanController;


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
//ALL POSTS
Route::get('posts', [PostController::class, 'showAllPosts']);

//SHOW CURRENT POST
Route::get('posts/{id}', [PostController::class, 'showPost']);


/*****CONTACT*****/
//SEND CONTACT
Route::post('contact', [ContactController::class, 'sendContactForm']);


//*****PLANS******/
//GET PLANS
Route::get('plans', [PlanController::class, 'showAllPlans']);

//SUBSCRIBE
Route::middleware('auth:sanctum')->post('subscriptions', [PlanController::class, 'subscribePlan']);
