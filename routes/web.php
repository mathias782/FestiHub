<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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
});

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::view('/', 'admin.dashboard')->name('admin.dashboard');
});

Route::get('/users/{user}', [PublicProfileController::class, 'show'])
    ->name('users.show');

// Publiek
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Inschrijven/uitschrijven (auth)
Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');
Route::delete('/events/{event}/register', [EventRegistrationController::class, 'destroy'])->name('events.unregister');

// Admin
Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');

    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('/events/{event}/attendees', [AdminEventController::class, 'attendees'])->name('admin.events.attendees');

    // FAQ beheer
    Route::get('/faq', [AdminFaqController::class, 'index'])->name('admin.faq.index');
    Route::post('/faq/categories', [AdminFaqController::class, 'storeCategory'])->name('admin.faq.categories.store');
    Route::delete('/faq/categories/{category}', [AdminFaqController::class, 'destroyCategory'])->name('admin.faq.categories.destroy');
    Route::post('/faq/items', [AdminFaqController::class, 'storeItem'])->name('admin.faq.items.store');
    Route::delete('/faq/items/{item}', [AdminFaqController::class, 'destroyItem'])->name('admin.faq.items.destroy');
});

require __DIR__.'/auth.php';
