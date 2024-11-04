<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*Route::get('/curr', function(){
    print_r(app()->make('redis'));
});*/
Route::redirect('/', '/index');
Route::get('/', function () {
    return Inertia::render('Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('/', App\Http\Controllers\PostController::class);
Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function () {
Route::get('/post-create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/post-store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
