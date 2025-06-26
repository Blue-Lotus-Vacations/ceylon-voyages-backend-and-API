<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //holidays
    Route::get('/holidays', [HolidayController::class, 'index'])->name('holidays');
    Route::get('/holidays/create-holiday', [HolidayController::class, 'create'])->name('holidays-create');
    Route::post('/holidays/create-holiday', [HolidayController::class, 'store'])->name('holidays.store');
    Route::get('/holidays/edit-holiday/{holiday_id}', [HolidayController::class, 'edit'])->name('holiday.edit');
    Route::put('/holidays/edit-holiday/{holiday_id}', [HolidayController::class, 'update'])->name('holiday.update');

    //assets
    Route::delete('/assets/{asset_id}', [AssetController::class, 'destroy'])->name('assets.delete');

});

require __DIR__.'/auth.php';
