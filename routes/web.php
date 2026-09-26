<?php

use App\Http\Controllers\ContactController;
use App\Http\Middleware\ProtectAgainstSpam;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'site/Home')->name('home');
Route::inertia('products', 'site/Products')->name('products');
Route::inertia('services', 'site/Services')->name('services');
Route::inertia('projects', 'site/Projects')->name('projects');
Route::inertia('about', 'site/About')->name('about');

Route::get('contacts', [ContactController::class, 'show'])->name('contacts');
Route::post('contacts', [ContactController::class, 'store'])
    ->middleware(['throttle:contact', ProtectAgainstSpam::class])
    ->name('contacts.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
