<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/category', App\Http\Controllers\CategoriesController::class)->middleware('auth');
Route::resource('/stocks-in', App\Http\Controllers\StocksInController::class)->middleware('auth');
Route::post('/search-name', [App\Http\Controllers\StocksInController::class, 'search_name'])->middleware('auth')->name('search.name');
Route::post('/search-date', [App\Http\Controllers\StocksInController::class, 'search_date'])->middleware('auth')->name('search.date');
Route::get('/category-list', [App\Http\Controllers\CategoriesController::class, 'list'])->middleware('auth')->name('category.list');
