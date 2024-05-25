<?php

use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReturnController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});

// book categories
Route::controller(BookCategoryController::class)->group(function () {
    Route::get('book-category/', 'index');
    Route::get('book-category/add', 'create');
});

// books
Route::controller(BookController::class)->group(function () {
    Route::get('book/', 'index');
    Route::get('book/add', 'create');
});

// borrow book
Route::controller(BookBorrowController::class)->group(function () {
    Route::get('book-borrow/', 'index');
    Route::get('book-borrow/add-borrow', 'create');
});

// return book
Route::controller(BookReturnController::class)->group(function () {
    Route::get('book-return/', 'index');
    Route::get('book-return/add-return', 'create');
});