<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ThemeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group([], function () {
        Route::resource('sections', SectionController::class);

        Route::get('/sections/{section}/branches', [SectionController::class, 'branchesIndex'])->name('sections.branches.index');
        Route::get('/sections/{section}/branches_except/{branch}', [SectionController::class, 'branchExceptIndex'])->name('sections.branches_except.index');
    });

    Route::group([], function () {
        Route::resource('branches', BranchController::class);

        Route::get('/branches/{branch}/theme/create', [BranchController::class, 'themeCreate'])->name('branches.themes.create');
    });

    Route::group([], function () {
        Route::resource('themes', ThemeController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
