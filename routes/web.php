<?php

use App\Http\Controllers\AdmiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;




//Rutas principales
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all-categories');

//Administrador
Route::get('/admin', [AdmiController::class, 'index'])->name('admin.index');

//Rutas del admin
Route::namespace('App\Http\Controllers')->prefix('admin')->group(function(){

    //Articulos
    Route::resource('articles', 'ArticleController')
                    ->except('show')
                    ->names('articles');
    //Rutas para las categorias
    Route::resource('categories', 'CategoryController')
                    ->except('show')    
                    ->names('categories');
    //comentarios
    Route::resource('comments', 'CommentController')
                    ->only('index', 'destroy')
                    ->names('comments');

});


// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/{srticle}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');



//Perfiles
Route::resource('profiles', ProfileController::class)
                ->only('edit', 'update')
                ->names('profiles');

//ver articulos
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

//ver articulos por categorias
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

//Guardar comentarios
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');


Auth::routes();

