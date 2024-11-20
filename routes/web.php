<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamoController;

Route::get('/store-activity/{userId}/{activityType}', [DynamoController::class, 'storeActivity']);
Route::get('/get-activities/{userId}', [DynamoController::class, 'getActivities']);

Route::get('/', function () {
    return view('welcome');
});
