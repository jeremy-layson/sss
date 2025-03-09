<?php

use App\Http\Controllers\WorkController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::get('/works/random', [WorkController::class, 'random']);
Route::get('/works/{id}', [WorkController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Work routes
    Route::post('/works', [WorkController::class, 'store']);
    Route::put('/works/{id}', [WorkController::class, 'update']);
    Route::post('/works/{id}/rate', [RatingController::class, 'rate']);
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/works', [AdminController::class, 'index']);
        Route::delete('/admin/works/{id}', [AdminController::class, 'destroy']);
    });
}); 