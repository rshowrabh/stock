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
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/category', App\Http\Controllers\CategoriesController::class)->middleware('auth');
Route::resource('/items', App\Http\Controllers\ItemsController::class)->middleware('auth');
Route::resource('/stocks-in', App\Http\Controllers\StocksInController::class)->middleware('auth');
Route::resource('/stocks-out', App\Http\Controllers\StocksOutController::class)->middleware('auth');
Route::get('/search-name', [App\Http\Controllers\StocksInController::class, 'search_name'])->middleware('auth')->name('search.name');
Route::get('/search-name-int', [App\Http\Controllers\StocksInController::class, 'search_name_int'])->middleware('auth')->name('search.name.int');
Route::get('/search-date', [App\Http\Controllers\StocksInController::class, 'search_date'])->middleware('auth')->name('search.date');
Route::get('/search-out-name', [App\Http\Controllers\StocksOutController::class, 'search_name'])->middleware('auth')->name('search.out.name');
Route::get('/search-out-member', [App\Http\Controllers\StocksOutController::class, 'search_member'])->middleware('auth')->name('search.out.member');
Route::get('/search-out-date', [App\Http\Controllers\StocksOutController::class, 'search_date'])->middleware('auth')->name('search.out.date');
Route::get('/search-out-int', [App\Http\Controllers\StocksOutController::class, 'search_out_int'])->middleware('auth')->name('search.out.int');
Route::get('/category-list', [App\Http\Controllers\CategoriesController::class, 'list'])->middleware('auth')->name('category.list');
Route::resource('/member', App\Http\Controllers\MemberController::class)->middleware('auth');
Route::resource('/images', App\Http\Controllers\ImagesController::class)->middleware('auth');
Route::post('/images-search', [App\Http\Controllers\ImagesController::class, 'image_search'])->middleware('auth')->name('image.search');
Route::get('/images-search-type', [App\Http\Controllers\ImagesController::class, 'image_search_type'])->middleware('auth')->name('image.search.type');
Route::get('/stocks', [App\Http\Controllers\StocksController::class, 'index'])->middleware('auth')->name('stocks');
Route::get('/stocks-search', [App\Http\Controllers\StocksController::class, 'search'])->middleware('auth')->name('stocks.search');
Route::post('/get-int', [App\Http\Controllers\StocksController::class, 'getInt'])->middleware('auth');
Route::get('/print', [App\Http\Controllers\StocksController::class, 'createPDF'])->name('pdf');
Route::get('/pdf_in', [App\Http\Controllers\StocksInController::class, 'createPDF'])->name('pdf.in');


Route::get('/multiple-in', [App\Http\Controllers\StocksInController::class, 'multiple_in'])->name('multiple.in');
Route::post('/multiple-in-store', [App\Http\Controllers\StocksInController::class, 'multiple_in_store'])->name('stocks-in.multiple');

Route::get('/multiple-out', [App\Http\Controllers\StocksOutController::class, 'multiple_out'])->name('multiple.out');
Route::post('/multiple-out-store', [App\Http\Controllers\StocksOutController::class, 'multiple_out_store'])->name('stocks-out.multiple');

