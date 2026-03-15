<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\LeverancierController;
use App\Http\Controllers\LeveringController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/Allergenen', [AllergeenController::class, 'index'])->name('Allergenen.index');

Route::get('Allergenen/categorie', [AllergeenController::class, 'categorie'])->name('Allergenen.categorie');

Route::get('/Allergenen/create', [AllergeenController::class, 'create'])->name('Allergenen.create');

Route::post('Allergenen', [AllergeenController::class, 'store'])->name('Allergenen.store');

Route::delete('Allergenen/{id}', [AllergeenController::class, 'destroy'])->name('Allergenen.destroy');

Route::get('Allergenen/{id}/edit', [AllergeenController::class, 'edit'])->name('Allergenen.edit');

Route::put('Allergenen/{id}', [AllergeenController::class, 'update'])->name('Allergenen.update');

Route::get('Allergenen/{id}', [AllergeenController::class, 'show'])->name('Allergenen.show');

Route::get('/Magazijn', [MagazijnController::class, 'index'])->name('Magazijn.index');

Route::get('Magazijn/{id}/AllergeenInfo', [MagazijnController::class, 'AllergeenInfo'])->name('Magazijn.AllergeenInfo');

Route::get('Magazijn/{id}/LeverantieInfo', [MagazijnController::class, 'LeverantieInfo'])->name('Magazijn.LeverantieInfo');

Route::get('/Leverancier', [LeverancierController::class, 'index'])->name('Leverancier.index');

Route::get('Leverancier/{id}/LeveringInfo', [LeverancierController::class, 'LeveringInfo'])->name('Leverancier.LeveringInfo');

Route::get('Leverancier/create', [LeverancierController::class, 'create'])->name('Leverancier.create');

Route::get('Leverancier/{id}/edit', [LeverancierController::class, 'edit'])->name('Leverancier.edit');

Route::get('Leverancier/{id}/info', [LeverancierController::class, 'LeverancierInfo'])->name('Leverancier.LeverancierInfo');

Route::get('Leverancier/{id}/gegevens', [LeverancierController::class, 'LeverancierGegevens'])->name('Leverancier.LeverancierGegevens');

Route::put('Leverancier/{id}', [LeverancierController::class, 'update'])->name('Leverancier.update');

Route::get('/Levering', [LeveringController::class, 'index'])->name('Levering.index');

Route::get('Levering/{product}', [LeveringController::class, 'show'])->name('Levering.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

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