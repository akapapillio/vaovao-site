<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;

Route::get('/', [ArticleController::class, 'welcome'])->name('welcome');
Route::get('/news', [ArticleController::class, 'frontIndex'])->name('articles.front');
Route::get('/{category}/{slug}-{id}-{idcat}.com', [ArticleController::class, 'show'])->name('articles.details');

Route::resource('articles', ArticleController::class);
