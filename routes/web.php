<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CharacterTeamController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Logout;
use App\Http\Controllers\MagicLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::resource('characters', CharacterController::class);
    Route::post('/characters/{character}/team', [CharacterTeamController::class, 'store'])
        ->name('characters.team.store');

    Route::post('/characters/{character}/team/join', [CharacterTeamController::class, 'join'])
        ->name('characters.team.join');

    Route::delete('/characters/{character}/team', [CharacterTeamController::class, 'leave'])
        ->name('characters.team.leave');

    Route::resource('events', EventController::class);
    Route::post('/events/{event}/invite', [EventController::class, 'invite'])
        ->name('events.invite');

    Route::post('events/{event}/registration/confirm', [EventRegistrationController::class, 'confirm'])
        ->name('events.registrations.confirm');
    Route::post('event-registrations/{eventRegistration}/accept', [EventRegistrationController::class, 'accept'])
        ->name('events.registrations.accept');
    Route::post('event-registrations/{eventRegistration}/refuse', [EventRegistrationController::class, 'refuse'])
        ->name('events.registrations.refuse');

    // User settings
    Route::get('/account/settings', [AccountSettingsController::class, 'edit'])
        ->name('account.settings');
    Route::put('/account/settings', [AccountSettingsController::class, 'update'])
        ->name('account.settings.update');

    Route::post('/logout', Logout::class)->name('logout');

    Route::middleware(['admin'])->group(function () {
        // routes admin
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin', [AdminController::class, 'invite'])->name('admin.invite');
    });
});

Route::get('/login', [MagicLinkController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [MagicLinkController::class, 'store'])->name('login.store');

Route::get('/magic-login/{email}', [MagicLinkController::class, 'loginViaToken'])
    ->name('login.token')
    ->middleware('signed');
