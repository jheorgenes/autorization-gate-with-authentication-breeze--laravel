<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Se autenticado, redirecionando para a tela de dashboard
    if(auth()->check()){
        return redirect()->route('dashboard');
    }
    //se não, redirecionando para a tela de login
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/create', [MainController::class, 'createPost'])->name('post.create');
    Route::post('/post/create', [MainController::class, 'storePost'])->name('post.store');
    /* Passando o id do post como parametro da rota */
    Route::get('/post/delete/{id}', [MainController::class, 'deletePost'])->name('post.delete');
});

require __DIR__.'/auth.php';
