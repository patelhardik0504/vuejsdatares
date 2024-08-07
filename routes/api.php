<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;

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

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', RegisterController::class);
    Route::post('/forgot-password', ForgotPasswordController::class);
    Route::post('/reset-password', ResetPasswordController::class);

    // guest verification (temporary auth)
    // Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    // Route::post('/verify-resend', [VerificationController::class, 'resend']);
});

Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
Route::post('/verify-resend', [VerificationController::class, 'resend']);

Route::middleware('auth:sanctum')->group(function () {
   

    Route::post('/logout', [AuthController::class, 'logout']);

    // in app verification
    // Route::post('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify');
    // Route::post('/verify-resend', [VerificationController::class, 'resend']);
    Route::post('/forms', [FormController::class, 'store']);
    Route::get('/forms/{id}', [FormController::class, 'show']);
    Route::post('/forms/{id}/approve', [FormController::class, 'approve']);
    Route::get('/forms/user', [FormController::class, 'userForm']);

    Route::middleware('check.form.submission')->group(function () {
        // Add all other API routes here that need to be protected
        Route::get('/protected-route', [FormController::class, 'index']);
        Route::patch('/profile', ProfileController::class);
        Route::patch('/password', PasswordController::class);
    });

});
Route::get('/user', UserController::class);

Route::apiResource('items', 'App\Http\Controllers\ItemController');
Route::get('/posts', [PostController::class, 'index']);

Route::get('/data', [PostController::class, 'state']);
Route::post('/save-selections', [PostController::class, 'SaveData']);

Route::get('/user-profile', [PostController::class, 'getProfile']);




Route::apiResource('user-profiles', UserProfileController::class);