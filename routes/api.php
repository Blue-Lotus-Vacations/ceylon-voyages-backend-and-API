<?php

use App\Http\Controllers\DestinationCategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EnquiryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    Route::get('/holidays', [HolidayController::class, 'holidayApi']);
    Route::get('/destinations', [DestinationController::class, 'destinationApi']);
    Route::get('/destination-categories', [DestinationCategoryController::class, 'destinationCategoryApi']);
    Route::post('/enquiry', [EnquiryController::class, 'enquiry']);