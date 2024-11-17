<?php

use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

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
    // Разделы
    Route::group([], function () {
        Route::resource('sections', SectionController::class);

        Route::get('/sections/{section}/branches', [SectionController::class, 'branchesIndex'])->name('sections.branches.index');
        Route::get('/sections/{section}/branches_except/{branch}', [SectionController::class, 'branchExceptIndex'])->name('sections.branches_except.index');
    });

    // Ветки
    Route::group([], function () {
        Route::resource('branches', BranchController::class);

        Route::get('/branches/{branch}/theme/create', [BranchController::class, 'themeCreate'])->name('branches.themes.create');
    });

    // Темы
    Route::group([], function () {
        Route::resource('themes', ThemeController::class);
    });

    // Сообщения
    Route::group([], function () {
        Route::resource('messages', MessageController::class);

        Route::post('/messages/{message}/likes', [MessageController::class, 'toggleLike'])->name('messages.likes.toggle');
        Route::post('/messages/{message}/complaints', [MessageController::class, 'storeComplaint'])->name('messages.complaints.store');
    });

    // Пользователи
    Route::group([], function () {
        Route::get('/users/personal', [UserController::class, 'personal'])->name('users.personal');
        Route::patch('/users/personal', [UserController::class, 'update'])->name('users.update');
    });

    // Изображения
    Route::group([], function () {
        Route::post('/images', [ImageController::class, 'store'])->name('images.store');
    });

    // Админка
    Route::group([], function () {
        Route::get('/admin', [MainController::class, 'index'])->name('admin.main.index');

        Route::get('/admin/complaints', [ComplaintController::class, 'index'])->name('admin.complaints.index');
        Route::patch('/admin/complaints/{complaint}', [ComplaintController::class, 'update'])->name('admin.complaints.update');

        Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/admin/roles', [RoleController::class, 'store'])->name('admin.roles.store');

        Route::post('/admin/users/{user}/roles', [AdminUserController::class, 'toggleRole'])->name('admin.users.roles.store');
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
