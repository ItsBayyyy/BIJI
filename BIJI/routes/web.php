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
Route::get('/user/riwayat/', [UserController::class, 'showRiwayat'])->name('loanHistory.index');
Route::get('/user/profile', [AuthController::class, 'showProfile']);
Route::post('/update-profile', [AuthController::class, 'updateProfile']);
Route::post('/update-email', [AuthController::class, 'updateEmail']);
Route::get('/user/username', [AuthController::class, 'showUsername']);
Route::get('/user/email', [AuthController::class, 'showEmail']);
Route::get('/user/password', [AuthController::class, 'showPassword']);

//admin
Route::get('/admin/book', [BookController::class, 'showAdminBook']);
Route::post('/book/add', [BookController::class, 'store']);
Route::get('/book/show/{id}', [BookController::class, 'showBook']);
Route::delete('/book/delete/{id}', [BookController::class, 'delete']);
Route::get('/book/edit/{id}', [BookController::class, 'getBookData']);
Route::post('/book/edit/{id}', [BookController::class, 'update']);

Route::get('/admin/data', [BookController::class, 'showAdminData']);
Route::post('/data/add', [BookController::class, 'storeFaq']);
Route::delete('/data/delete/{id}', [BookController::class, 'deleteFaq']);

Route::get('/admin/pinjam', [BookController::class, 'showAdminLoan']);
Route::post('/book/approve/{bookId}', [BookController::class, 'approveLoan']);
Route::post('/book/rejected/{bookId}', [BookController::class, 'rejectedLoan']);