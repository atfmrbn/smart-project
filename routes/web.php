<?php

use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\LibraryController;
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

// books
Route::controller(BookController::class)->group(function () {
    Route::get('library/', 'index');
    Route::get('library/add-book', 'create');
});

Route::controller(BookBorrowController::class)->group(function () {
    Route::get('book-borrow/', 'index');
    Route::get('book-borrow/add-borrow', 'create');
});

Route::controller(BookReturnController::class)->group(function () {
    Route::get('book-return/', 'index');
    Route::get('book-return/add-return', 'create');
});


// Route::get('/library', [LibraryController::class, 'index']);
Route::prefix('/')->group(
    function (){
        // Route::resource('/library', LibraryController::class);
        // Route::resource('/category', CategoryController::class);
        // Route::resource('/menu', MenuController::class);
        // Route::resource('/receipt', ReceiptController::class);
        // Route::resource('/receipt-detail', ReceiptDetailController::class);
        // Route::get('/report', [ReportController::class, 'index']);

    }
);

