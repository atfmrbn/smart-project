<?php

use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\StudentController;
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
    Route::get('book-category/', 'index')->name('book-category.index');
    Route::get('book-category/add', 'create')->name('book-category.create');
    Route::post('book-category/', 'store')->name('book-category.store');
    Route::get('book-category/{id}/edit', 'edit')->name('book-category.edit');
    Route::put('book-category/{id}/update', 'update')->name('book-category.update');
    Route::delete('book-category/{id}', 'destroy')->name('book-category.destroy');
});

// books
Route::controller(BookController::class)->group(function () {
    Route::get('book/', 'index')->name('book.index');;
    Route::get('book/add', 'create')->name('book.create');;
    Route::post('book/', 'store')->name('book.store');
    Route::get('book/{id}/edit', 'edit')->name('book.edit');
    Route::put('book/{id}/update', 'update')->name('book.update');
    Route::delete('book/{id}', 'destroy')->name('book.destroy');
});

// borrow book
Route::controller(BookBorrowController::class)->group(function () {
    Route::get('book-borrow/', 'index');
    Route::get('book-borrow/add', 'create');
});

// return book
Route::controller(BookReturnController::class)->group(function () {
    Route::get('book-return/', 'index');
    Route::get('book-return/add', 'create');
});

// Route::controller(StudentController::class)->group(function () {
//     // Route::resource('/student/student-teacher-classroom', StudentController::class);
//     Route::get('/student/student-teacher-classroom', 'index');
//     Route::get('/student/student-teacher-classroom/add', 'create');
//     Route::post('/student/student-teacher-classroom', 'store');
//     Route::get('/student/student-teacher-classroom/{id}/edit', 'edit');
//     Route::put('/student/student-teacher-classroom/{id}/update', 'update');
//     Route::delete('/student/student-teacher-classroom/delete/{id}', 'destroy');
// });
Route::resource('/student/student-teacher-classroom', StudentController::class);

Route::resource('/curriculum', CurriculumController::class);
Route::put('curriculum/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');