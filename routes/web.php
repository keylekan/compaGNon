<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Logout;
use App\Http\Controllers\MagicLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::view('/', 'home')->name('home');

    Route::resource('characters', CharacterController::class);
    Route::resource('events', EventController::class)->only(['index', 'show']);

    // User settings
    Route::get('/account/settings', [AccountSettingsController::class, 'edit'])
        ->name('account.settings');
    Route::put('/account/settings', [AccountSettingsController::class, 'update'])
        ->name('account.settings.update');

    Route::post('/logout', Logout::class)->name('logout');
});

Route::get('/login', [MagicLinkController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [MagicLinkController::class, 'store'])->name('login.store');

Route::get('/magic-login/{email}', [MagicLinkController::class, 'loginViaToken'])
    ->name('login.token')
    ->middleware('signed');
