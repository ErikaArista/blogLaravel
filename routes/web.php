<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


//Rutas principales
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Rutas para los articulos

Route::resource('articles', ArticleController::class)
->except('show')
->names('articles');

// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/{srticle}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

//Rutas para las categorias
Route::resource('categories', CategoryController::class)
->except('show')    
->names('categories');


//ver articulos
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

//ver articulos por categorias
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

Auth::routes();

