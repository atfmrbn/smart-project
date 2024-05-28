<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookBorrowDetailController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.admin');
});

Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('teacher.dashboard');



Route::controller(BookCategoryController::class)->group(function () {
    Route::get('book-category/', 'index')->name('book-category.index');
    Route::get('book-category/add', 'create')->name('book-category.create');
    Route::post('book-category/', 'store')->name('book-category.store');
    Route::get('book-category/{id}/edit', 'edit')->name('book-category.edit');
    Route::put('book-category/{id}/update', 'update')->name('book-category.update');
    Route::delete('book-category/{id}', 'destroy')->name('book-category.destroy');
});

Route::controller(BookController::class)->group(function () {
    Route::get('book/', 'index')->name('book.index');
    Route::get('book/add', 'create')->name('book.create');
    Route::post('book/', 'store')->name('book.store');
    Route::get('book/{id}/edit', 'edit')->name('book.edit');
    Route::put('book/{id}/update', 'update')->name('book.update');
    Route::delete('book/{id}', 'destroy')->name('book.destroy');
});

Route::controller(BookBorrowController::class)->group(function () {
    Route::get('book-borrow/', 'index')->name('book-borrow.index');
    Route::get('book-borrow/add', 'create')->name('book-borrow.create');
    Route::post('book-borrow/', 'store')->name('book-borrow.store');
    Route::get('book-borrow/{id}/edit', 'edit')->name('book-borrow.edit');
    Route::put('book-borrow/{id}/update', 'update')->name('book-borrow.update');
    Route::delete('book-borrow/{id}', 'destroy')->name('book-borrow.destroy');
});

// borrow book detail
Route::controller(BookBorrowDetailController::class)->group(function () {
    Route::get('book-borrow-detail/', 'index')->name('book-borrow-detail.index');
    Route::get('book-borrow-detail/add', 'create')->name('book-borrow-detail.create');
    Route::post('book-borrow-detail/', 'store')->name('book-borrow-detail.store');
    Route::get('book-borrow-detail/{id}/edit', 'edit')->name('book-borrow-detail.edit');
    Route::put('book-borrow-detail/{id}/update', 'update')->name('book-borrow-detail.update');
    Route::delete('book-borrow-detail/{id}', 'destroy')->name('book-borrow-detail.destroy');
});

Route::controller(BookReturnController::class)->group(function () {
    Route::get('book-return/', 'index')->name('book-return.index');
    Route::get('book-return/add', 'create')->name('book-return.create');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('/student/student-teacher-classroom', 'index')->name('student.index');
    Route::get('/student/student-teacher-classroom/add', 'create')->name('student.create');
    Route::post('/student/student-teacher-classroom', 'store')->name('student.store');
    Route::get('/student/student-teacher-classroom/{id}/edit', 'edit')->name('student.edit');
    Route::put('/student/student-teacher-classroom/{id}/update', 'update')->name('student.update');
    Route::delete('/student/student-teacher-classroom/delete/{id}', 'destroy')->name('student.destroy');
});

Route::controller(TeacherController::class)->group(function () {
    Route::get('/teacher/teacher-list', 'index')->name('teacher.index');
    Route::get('/teacher/teacher-list/add', 'create')->name('teacher.create');
    Route::post('/teacher/teacher-list', 'store')->name('teacher.store');
    Route::get('/teacher/teacher-list/{id}/edit', 'edit')->name('teacher.edit');
    Route::put('/teacher/teacher-list/{id}', 'update')->name('teacher.update');
    Route::delete('/teacher/teacher-list/{id}', 'destroy')->name('teacher.destroy');
});

Route::controller(LibrarianController::class)->group(function () {
    Route::get('/librarian/librarian-list', 'index')->name('librarian.index');
    Route::get('/librarian/librarian-list/add', 'create')->name('librarian.create');
    Route::post('/librarian/librarian-list', 'store')->name('librarian.store');
    Route::get('/librarian/librarian-list/{id}/edit', 'edit')->name('librarian.edit');
    Route::put('/librarian/librarian-list/{id}', 'update')->name('librarian.update');
    Route::delete('/librarian/librarian-list/{id}', 'destroy')->name('librarian.destroy');
});
