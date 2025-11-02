<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\MagazijnController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/Allergenen', [AllergeenController::class, 'index'])->name('Allergenen.index');

Route::get('/Allergenen/create', [AllergeenController::class, 'create'])->name('Allergenen.create');

Route::post('Allergenen', [AllergeenController::class, 'store'])->name('Allergenen.store');

Route::delete('Allergenen/{id}', [AllergeenController::class, 'destroy'])->name('Allergenen.destroy');

Route::get('Allergenen/{id}/edit', [AllergeenController::class, 'edit'])->name('Allergenen.edit');

Route::put('Allergenen/{id}', [AllergeenController::class, 'update'])->name('Allergenen.update');

Route::get('/Magazijn', [MagazijnController::class, 'index'])->name('Magazijn.index');

Route::post('Magazijn', [MagazijnController::class, 'store'])->name('Magazijn.store');

Route::delete('Magazijn/{id}', [MagazijnController::class, 'destroy'])->name('Magazijn.destroy');

Route::put('Magazijn/{id}', [MagazijnController::class, 'update'])->name('Magazijn.update');

Route::get('/magazijn/{id}/AllergenenInfo', [MagazijnController::class, 'AllergenenInfo'])->name('magazijn.AllergenenInfo');

Route::get('/magazijn/{id}/LeverantieInfo', [MagazijnController::class, 'LeverantieInfo'])->name('magazijn.LeverantieInfo');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
