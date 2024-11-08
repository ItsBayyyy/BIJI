<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//auth
Route::group(['middleware' => 'common.helper'], function() {
    Route::get('/auth', [AuthController::class, 'showAuth']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/activate', [AuthController::class, 'showActivate']);
    Route::get('/activate/{token}', [AuthController::class, 'activate']);
    Route::get('/forgot-password', [AuthController::class, 'showSearchAccountForm'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendResetPasswordLink']);
    Route::get('/forgot-password/info', [AuthController::class, 'showForgot']);
    Route::get('/reset-password/info', [AuthController::class, 'showSuksesForgot']);
    Route::get('/reset-password/{token}', [AuthController::class, 'showChangePasswordForm'])->name('reset-password-form');
    Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
});

Route::post('/logout', function () {
    Auth::logout(); 
    return response()->json(['message' => 'Successfully logged out']);
});

Route::post('/chat', [ChatbotController::class, 'chat']);
Route::post('/learn', [ChatbotController::class, 'learnNewInfo']);
Route::get('/recall/{topic}', [ChatbotController::class, 'recallInfo']);

//user
Route::get('/book/beranda', [UserController::class, 'showBeranda']);
Route::get('/book/favorite', [UserController::class, 'showFavorite']);
Route::get('/book/search', [UserController::class, 'search'])->name('books.search');
Route::get('/book/detail/{book_id}', [UserController::class, 'show'])->name('book.detail');
Route::post('/book/toggle', [UserController::class, 'toggle'])->name('favorite.toggle');
Route::get('/book/loan-history/', [UserController::class, 'showRiwayat'])->name('loanHistory.index');