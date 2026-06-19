<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Posts\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Route::resource('/posts', PostController::class);

        Route::get('/posts', [PostController::class, 'index_livewire'])
        ->name('posts.index_livewire');

        Route::get('/posts/create', [PostController::class, 'create'])
            ->name('posts.create');

        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])
            ->name('posts.edit');

        Route::get('/posts/{id}', [PostController::class, 'show'])
            ->name('posts.show');




        // with out controller
        // Route::livewire('/livewire/posts', Index::class)->name('Posts.index_livewire');
        

});

require __DIR__.'/auth.php';
