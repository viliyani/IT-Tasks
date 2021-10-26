<?php

use App\Http\Controllers\API\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Better Way --> Route::apiResource('articles', ArticleController::class);

// Patterns
Route::pattern('id', '\d+');

// Endpoints
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

