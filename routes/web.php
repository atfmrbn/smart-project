<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
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
    return view('dashboard.admin');
});

Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('teacher.dashboard');

// book categories
Route::get('book-category', [BookCategoryController::class, 'index']);
Route::get('book-category/add', [BookCategoryController::class, 'create']);

// books
Route::get('book', [BookController::class, 'index']);
Route::get('book/add', [BookController::class, 'create']);

// borrow book
Route::get('book-borrow', [BookBorrowController::class, 'index']);
Route::get('book-borrow/add-borrow', [BookBorrowController::class, 'create']);

// return book
Route::get('book-return', [BookReturnController::class, 'index']);
Route::get('book-return/add-return', [BookReturnController::class, 'create']);

Route::get('teacher/teacher-list', [TeacherController::class, 'index']);
Route::get('teacher/teacher-list/add', [TeacherController::class, 'create']);
Route::post('teacher/teacher-list', [TeacherController::class, 'store']);
