<?php

use App\Models\BorrowingBookDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TuitionController;
use App\Http\Controllers\TaskTypeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BookReturnController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\GradeDetailController;
use App\Http\Controllers\TuitionTypeController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BorrowingBookController;
use App\Http\Controllers\ClassroomTypeController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\TuitionDetailController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\TeacherScheduleController;
use App\Http\Controllers\BookBorrowDetailController;
use App\Http\Controllers\TeacherSubjectRelationshipController;
use App\Http\Controllers\TeacherHomeroomRelationshipController;
use App\Http\Controllers\TeacherClassroomRelationshipController;
use App\Http\Controllers\StudentExtracurricularRelationshipController;
use App\Http\Controllers\StudentTeacherHomeroomRelationshipController;
use App\Http\Controllers\StudentTeacherClassroomRelationshipController;

    Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

    // Untuk redirect ke Google
    Route::get('login/google/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');

    // Untuk callback dari Google
    Route::get('login/google/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password')->middleware('guest');
    Route::post('/forgot-password', [AuthController::class, 'sendEmailReset'])->name('email-reset')->middleware('guest');

    Route::get('/reset-password/{token}', [AuthController::class, 'emailResetPassword'])->name('email-reset-password')->middleware('guest');
    Route::post('/reset-password', [AuthController::class, 'ResetPassword'])->name('reset-passowrd')->middleware('guest');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update-profile', [ProfileController::class, 'updateProfile']);
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword']);
    // Route::post('/profile/update-image', [ProfileController::class, 'updateImage']);

    Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/teacher', [DashboardController::class, 'teacher']);
    Route::get('/dashboard/superAdmin', [DashboardController::class, 'superAdmin'])->name('superAdmin.dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/dashboard/librarian', [DashboardController::class, 'librarian'])->name('librarian.dashboard');
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('student.dashboard');
    Route::get('/dashboard/parent', [DashboardController::class, 'parent'])->name('parent.dashboard');


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

    Route::resource('/parent/parent-list', ParentController::class);
    Route::get('/parent-list/download', [ParentController::class, 'download'])->name('parent.download');
    Route::resource('/student/student-list', StudentController::class);
    Route::get('/student-list/download', [StudentController::class, 'download'])->name('student.download');
    Route::resource('/student/student-teacher-classroom', StudentTeacherClassroomRelationshipController::class);
    Route::resource('/student/student-teacher-homeroom', StudentTeacherHomeroomRelationshipController::class);
    Route::get('/student-teacher-homeroom/download', [StudentTeacherHomeroomRelationshipController::class, 'download'])->name('student-teacher.download');

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
        Route::get('/teacher-list/download', [TeacherController::class, 'download'])->name('teacher.download');
    });

    Route::controller(LibrarianController::class)->group(function () {
        Route::get('/librarian/librarian-list', 'index')->name('librarian.index');
        Route::get('/librarian/librarian-list/add', 'create')->name('librarian.create');
        Route::post('/librarian/librarian-list', 'store')->name('librarian.store');
        Route::get('/librarian/librarian-list/{id}/edit', 'edit')->name('librarian.edit');
        Route::put('/librarian/librarian-list/{id}', 'update')->name('librarian.update');
        Route::delete('/librarian/librarian-list/{id}', 'destroy')->name('librarian.destroy');
        Route::get('/librarian-list/download', [LibrarianController::class, 'download'])->name('librarian.download');
    });

    Route::controller(TeacherHomeroomRelationshipController::class)->group(function () {
        Route::get('/teacher/teacher-homeroom', 'index')->name('teacher-homeroom.index');
        Route::get('/teacher/teacher-homeroom/add', 'create')->name('teacher-homeroom.create');
        Route::post('/teacher/teacher-homeroom', 'store')->name('teacher-homeroom.store');
        Route::get('/teacher/teacher-homeroom/{id}/edit', 'edit')->name('teacher-homeroom.edit');
        Route::put('/teacher/teacher-homeroom/{id}', 'update')->name('teacher-homeroom.update');
        Route::delete('/teacher/teacher-homeroom/{id}', 'destroy')->name('teacher-homeroom.destroy');
        Route::get('/teacher-homeroom/download', [TeacherHomeroomRelationshipController::class, 'download'])->name('teacher-homeroom.download');
    });

    Route::resource('/teacher/teacher-subject', TeacherSubjectRelationshipController::class);
    Route::get('/teacher-subject/download', [TeacherSubjectRelationshipController::class, 'download'])->name('teacher-subject.download');

    Route::resource('/teacher/teacher-classroom', TeacherClassroomRelationshipController::class);
    Route::get('/teacher-classroom/download', [TeacherClassroomRelationshipController::class, 'download'])->name('teacher-classroom.download');

    Route::resource('/teacher/teacher-schedule', TeacherScheduleController::class);
    Route::get('/teacher-schedule/download', [TeacherScheduleController::class, 'download'])->name('teacher-schedule.download');

    Route::resource('teacher/grade', GradeController::class);
    Route::get('grade/download', [GradeController::class, 'download'])->name('grade.download');
    Route::resource('teacher/grade-detail', GradeDetailController::class);
    Route::get('grade-detail/download', [GradeDetailController::class, 'download'])->name('grade-detail.download');
    Route::get('grade-detail/report-download/{id}', [GradeDetailController::class, 'reportDownload'])->name('grade-detail.report-download');

    Route::resource('/user', UserController::class)->middleware('checkRole:Super Admin');
    Route::resource('attendance', AttendanceController::class);


    // Route::get('/user', [UserController::class, 'editProfile'])->name('user.edit-profile');
    // Route::post('/user', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::resource('attendance', AttendanceController::class);
    Route::get('attendance/download', [AttendanceController::class, 'download'])->name('attendance.download');

    // Route::get('parents/create', [ParentController::class, 'create'])->name('parents.create');
    // Route::post('parents', [ParentController::class, 'store'])->name('parents.store');
    Route::get('dashboard', [DashboardController::class, 'parent'])->name('dashboard')->middleware('auth');

    Route::resource('tuition-type', TuitionTypeController::class);
    Route::resource('tuition', TuitionController::class);
    Route::resource('tuition-detail', TuitionDetailController::class);
    // Route::get('/tuition/{tuition}/payoff', [TuitionDetailController::class, 'Payoff'])->name('tuition.payoff');
    Route::post('/tuition/{id}/payoff', [TuitionDetailController::class, 'payOff'])->name('tuition.payoff');
    Route::get('/invoice/{id}', [TuitionDetailController::class, 'invoice'])->name('invoice.show');

    // Route::get('/tuition/{id}/paymidtrans', [TuitionDetailController::class, 'payMidtrans'])->name('tuition.paymidtrans');

});
