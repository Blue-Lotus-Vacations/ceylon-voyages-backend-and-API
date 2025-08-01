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
use App\Http\Controllers\DestinationCategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\LanguageController;

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
    Route::get('/holidays/check-slug', [HolidayController::class, 'checkSlug'])->name('holiday.slug');


    //holiday itinerary
    Route::get('/holidays/itinerary/index/{holiday}', [HolidayController::class, 'itinerary_index'])->name('holiday.itenery-index');
    Route::get('/holidays/{holiday}/itinerary/{itinerary}', [HolidayController::class, 'itinerary_show'])->name('holiday.itenery-show');
    Route::get('/holidays/itinerary/create/{holiday}', [HolidayController::class, 'itinerary_create'])->name('holiday.itenery-create');
    Route::post('/holidays/itinerary/store/{holiday}', [HolidayController::class, 'itinerary_store'])->name('holiday.itenery-store');
    Route::get('/holidays/itinerary/edit/{itinerary}/holiday/{holiday}', [HolidayController::class, 'itinerary_edit'])->name('holiday.itenery-edit');
    Route::put('/holidays/itinerary/update/{holiday}/{itinerary}', [HolidayController::class, 'itinerary_update'])->name('holiday.itenery-update');
    Route::get('/holidays/itinerary/delete/{itinerary}/{holiday}', [HolidayController::class, 'itinerary_destroy'])->name('holiday.itenery-delete');
    Route::delete('/itinerary-images/delete', [HolidayController::class, 'deleteImage'])->name('holiday.itenery-image-delete');


    //destionation categories
    Route::get('/destination-category', [DestinationCategoryController::class, 'index'])->name('destination-category');
    Route::get('/destination-category/create-destination-category', [DestinationCategoryController::class, 'create'])->name('destination-category-create');
    Route::post('/destination-category/create-destination-category', [DestinationCategoryController::class, 'store'])->name('destination-category.store');
    Route::get('/destination-category/edit-destination-category/{destination_category_id}', [DestinationCategoryController::class, 'edit'])->name('destination_category.edit');
    Route::put('/destination-category/edit-destination-category/{destination_category_id}', [DestinationCategoryController::class, 'update'])->name('destination_category.update');
    Route::get('/destination-category/check-slug', [DestinationCategoryController::class, 'checkSlug'])->name('destination_category.slug');
    

    //destinations
    Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations');
    Route::get('/destinations/create-destinations', [DestinationController::class, 'create'])->name('destination-create');
    Route::post('/destinations/create-destinations', [DestinationController::class, 'store'])->name('destination.store');
    Route::get('/destinations/edit-destination/{destination_id}', [DestinationController::class, 'edit'])->name('destination.edit');
    Route::put('/destinations/edit-destination/{destination_id', [DestinationController::class, 'update'])->name('destination.update');
    Route::get('/destinations/check-slug', [DestinationController::class, 'checkSlug'])->name('destination.slug');

    //languages
    Route::get('/languages', [LanguageController::class, 'index'])->name('languages');
    Route::get('/languages/create-languages', [LanguageController::class, 'create'])->name('language-create');
    Route::post('/languages/create-languages', [LanguageController::class, 'store'])->name('language.store');
    Route::get('/languages/edit-language/{language_id}', [LanguageController::class, 'edit'])->name('language.edit');
     Route::put('/languages/edit-language/{language_id}', [LanguageController::class, 'update'])->name('language.update');

    //assets
    Route::delete('/assets/{asset_id}', [AssetController::class, 'destroy'])->name('assets.delete');
});

require __DIR__ . '/auth.php';
