<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

require __DIR__.'/auth.php';


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () { 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
