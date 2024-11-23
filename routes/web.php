<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\TestController;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/test-upload', [TestController::class, 'testUpload']);

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');


// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// Ruta principal protegida por autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/principal', [PostController::class, 'principal'])->name('principal');
});


// Rutas para DynamoDB (no requieren autenticación)
Route::get('/store-activity/{userId}/{activityType}', [DynamoController::class, 'storeActivity']);
Route::get('/get-activities/{userId}', [DynamoController::class, 'getActivities']);
