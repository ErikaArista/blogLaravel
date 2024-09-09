<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Rutas principales
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Rutas para los articulos
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');