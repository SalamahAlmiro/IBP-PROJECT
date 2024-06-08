<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\LoginUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

    Route::middleware('is-admin')->group(function() {
        Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
        Route::get('/admin/table', [AdminController::class, 'table'])->name('admin.table');
        Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/newUser', [RegisterUserController::class, 'newUser'])->name('newUser');
        Route::post('/newUser', [RegisterUserController::class, 'storeNew'])->name('newUser.store');
    });
});
Route::get('search',[PostController::class, 'search' ], function (Request $request) {
    return $request->search();
})->name('posts.search');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::view('/','welcome');
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginUserController::class, 'login'])->name('login');
    Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');
});

