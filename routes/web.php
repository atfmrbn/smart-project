<?php

use App\Models\BorrowingBookDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TaskTypeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BorrowingBookController;
use App\Http\Controllers\ClassroomTypeController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\BookBorrowDetailController;
use App\Http\Controllers\TeacherSubjectRelationshipController;
use App\Http\Controllers\TeacherHomeroomRelationshipController;
use App\Http\Controllers\TeacherClassroomRelationshipController;
use App\Http\Controllers\StudentExtracurricularRelationshipController;
use App\Http\Controllers\StudentTeacherHomeroomRelationshipController;
use App\Http\Controllers\StudentTeacherClassroomRelationshipController;

Route::get('/', [DashboardController::class, 'admin'])->middleware('auth');

Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/teacher', [DashboardController::class, 'teacher']);
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/dashboard/librarian', [DashboardController::class, 'librarian'])->name('librarian.dashboard');
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('student.dashboard');


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

    Route::resource('book-borrow', BorrowingBookController::class);
    Route::put('book-borrow-detail/{id}/return', [BookBorrowDetailController::class, 'returnBook'])->name('book-borrow-detail.return');

    Route::get('book-borrow-download', [BorrowingBookController::class, 'download']);
    Route::get('book-borrow-detail-download/{id}', [BookBorrowDetailController::class, 'download']);

    Route::controller(BookBorrowDetailController::class)->group(function () {
        Route::get('book-borrow-detail/', 'index')->name('book-borrow-detail.index');
        Route::get('book-borrow-detail/add', 'create')->name('book-borrow-detail.create');
        Route::post('book-borrow-detail/', 'store')->name('book-borrow-detail.store');
        Route::get('book-borrow-detail/{id}/edit', 'edit')->name('book-borrow-detail.edit');
        Route::put('book-borrow-detail/{id}/update', 'update')->name('book-borrow-detail.update');
        Route::delete('book-borrow-detail/{id}', 'destroy')->name('book-borrow-detail.destroy');
    });

    // Route untuk filterByDate
    Route::get('book-return', [BorrowingBookController::class, 'reportByDate']);

    Route::controller(BookReturnController::class)->group(function () {
        Route::get('book-return/', 'index')->name('book-return.index');
        Route::get('book-return', 'filter')->name('bookReturn.filterByDate');
        Route::get('book-return/download', 'downloadPdf')->name('book-return.download');
    });

    Route::resource('/student/student-list', StudentController::class);
    Route::resource('/student/student-teacher-classroom', StudentTeacherClassroomRelationshipController::class);
    Route::resource('/student/student-teacher-homeroom', StudentTeacherHomeroomRelationshipController::class);

    Route::resource('/classroom/classroom-type', ClassroomTypeController::class);
    Route::resource('/classroom', ClassroomController::class);
    Route::resource('attendance', AttendanceController::class);

    Route::resource('/extracurricular', ExtracurricularController::class);
    Route::resource('/extracurricular-student', StudentExtracurricularRelationshipController::class);

    Route::resource('subject', SubjectController::class);

    Route::resource('curriculum', CurriculumController::class);
    Route::put('curriculum/{id}/setDefault', [CurriculumController::class, 'setDefault'])->name('curriculum.setDefault');

    Route::resource('task-type', TaskTypeController::class);

    Route::resource('configuration', ConfigurationController::class);

    Route::resource('book-return', BookReturnController::class);


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

    Route::controller(TeacherHomeroomRelationshipController::class)->group(function () {
        Route::get('/teacher/teacher-homeroom', 'index')->name('teacher-homeroom.index');
        Route::get('/teacher/teacher-homeroom/add', 'create')->name('teacher-homeroom.create');
        Route::post('/teacher/teacher-homeroom', 'store')->name('teacher-homeroom.store');
        Route::get('/teacher/teacher-homeroom/{id}/edit', 'edit')->name('teacher-homeroom.edit');
        Route::put('/teacher/teacher-homeroom/{id}', 'update')->name('teacher-homeroom.update');
        Route::delete('/teacher/teacher-homeroom/{id}', 'destroy')->name('teacher-homeroom.destroy');
    });

    Route::resource('/teacher/teacher-subject', TeacherSubjectRelationshipController::class);
    Route::resource('/teacher/teacher-classroom', TeacherClassroomRelationshipController::class);
    Route::resource('teacher/grade', GradeController::class);

    Route::resource('/user', UserController::class)->middleware('checkRole:Super Admin');
    Route::resource('attendance', AttendanceController::class);

});
