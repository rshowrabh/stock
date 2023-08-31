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

Route::get('/link', function () {
    Artisan::call('storage:link');
});

Route::get('/', [App\Http\Controllers\StocksController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/category', App\Http\Controllers\CategoriesController::class)->middleware('auth');
Route::resource('/items', App\Http\Controllers\ItemsController::class)->middleware('auth');
Route::resource('/stocks-in', App\Http\Controllers\StocksInController::class)->middleware('auth');
Route::resource('/stocks-out', App\Http\Controllers\StocksOutController::class)->middleware('auth');
Route::post('/search-name', [App\Http\Controllers\StocksInController::class, 'search_name'])->middleware('auth')->name('search.name');
Route::post('/search-date', [App\Http\Controllers\StocksInController::class, 'search_date'])->middleware('auth')->name('search.date');
Route::post('/search-out-name', [App\Http\Controllers\StocksOutController::class, 'search_name'])->middleware('auth')->name('search.out.name');
Route::post('/search-out-member', [App\Http\Controllers\StocksOutController::class, 'search_member'])->middleware('auth')->name('search.out.member');
Route::post('/search-out-date', [App\Http\Controllers\StocksOutController::class, 'search_date'])->middleware('auth')->name('search.out.date');
Route::get('/category-list', [App\Http\Controllers\CategoriesController::class, 'list'])->middleware('auth')->name('category.list');
Route::resource('/member', App\Http\Controllers\MemberController::class)->middleware('auth');
Route::resource('/images', App\Http\Controllers\ImagesController::class)->middleware('auth');
Route::post('/images-search', [App\Http\Controllers\ImagesController::class, 'image_search'])->middleware('auth')->name('image.search');
Route::get('/stocks', [App\Http\Controllers\StocksController::class, 'index'])->middleware('auth')->name('stocks');
Route::post('/stocks', [App\Http\Controllers\StocksController::class, 'search'])->middleware('auth')->name('stocks.search');
Route::post('/get-int', [App\Http\Controllers\StocksController::class, 'getInt'])->middleware('auth');
