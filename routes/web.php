<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dynamic\Create;
use App\Livewire\Dynamic\Edit;
use App\Livewire\Dynamic\Index;
use App\Livewire\Dynamic\Show;
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

    // controller crud step 1
        // Route::resource('/posts', PostController::class);

    // with out controller step 2
        // Route::livewire('/livewire/posts', Index::class)->name('Posts.index_livewire');


    // Livewire crud step 3
        Route::get('/posts', [PostController::class, 'index_livewire'])
        ->name('posts.index_livewire');

        Route::get('/posts/create', [PostController::class, 'create'])
            ->name('posts.create');

        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])
            ->name('posts.edit');

        Route::get('/posts/{id}', [PostController::class, 'show'])
            ->name('posts.show');

    // Livewire dynamic crud step 4
        //  Route::get('/dynamic/posts', 'dynamic.index');
        //  Route::get('/dynamic/posts/create', 'dynamic.create');
        //  Route::get('/dynamic/posts/{post-id}', 'dynamic.show');
        //  Route::get('/dynamic/posts/{post-id}/edit', 'dynamic.edit');

         Route::get('/dynamic/posts', Index::class);
         Route::get('/dynamic/posts/create', Create::class);
         Route::get('/dynamic/posts/{post-id}', Show::class);
         Route::get('/dynamic/posts/{post-id}/edit', Edit::class);




        // with out controller
        // Route::livewire('/livewire/posts', Index::class)->name('Posts.index_livewire');
        

});

require __DIR__.'/auth.php';
