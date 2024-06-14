@php
    $currentRoute = Route::currentRouteName();
    $currentUrl = URL::current();
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                {{-- <li class="submenu {{ request()->is('/') || request()->is('teacher/dashboard') || request()->is('student/dashboard') ? 'active' : '' }}">
                    <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
                    <ul> --}}
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ URL::to('/') }}" class=""><i class="feather-grid"></i><span> Admin Dashboard</span></a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/teacher') ? 'active' : '' }}">
                    <a href="{{ route('teacher.dashboard') }}" class=""><i class="feather-grid"></i><span> Teacher Dashboard</span></a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/student') ? 'active' : '' }}">
                    <a href="{{ route('student.dashboard') }}" class=""><i class="feather-grid"></i><span> Student Dashboard</span></a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/librarian') ? 'active' : '' }}">
                    <a href="{{ route('librarian.dashboard') }}" class=""><i class="feather-grid"></i><span> Librarian Dashboard</span></a>
                </li>
                    {{-- </ul>
                </li> --}}
                <li class="submenu {{ request()->is('student/*') || request()->is('extracurricular*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ URL::to('/student/student-list') }}" class="{{ request()->is('student/student-list') ? 'active' : '' }}">Student List</a></li>
                        <li><a href="{{ URL::to('/student/student-teacher-homeroom') }}" class="{{ request()->is('student/student-teacher-homeroom') ? 'active' : '' }}">Student Teacher Homeroom</a></li>
                        <li><a href="{{ URL::to('/extracurricular') }}" class="{{ request()->is('extracurricular') ? 'active' : '' }}">Extracurricular Activities</a></li>
                        <li><a href="{{ URL::to('/extracurricular-student') }}" class="{{ request()->is('extracurricular-student') ? 'active' : '' }}">Extracurricular Participants</a></li>
                    </ul>
                </li>
                <li class="submenu {{ request()->is('parents/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-parent"></i> <span> Parents</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ URL::to('/parents/parent-list') }}" class="{{ request()->is('parents/parent-list') ? 'active' : '' }} || {{ request()->is('parents/parent-list/add') ? 'active' : '' }}">Parents List</a></li>
                        {{-- <li><a href="{{ URL::to('/teacher/teacher-homeroom') }}" class="{{ request()->is('teacher/teacher-homeroom') ? 'active' : '' }} || {{ request()->is('teacher/teacher-homeroom/add') ? 'active' : '' }}">Teacher Homeroom</a></li>
                        <li><a href="{{ URL::to('/teacher/teacher-classroom') }}" class="{{ request()->is('teacher/teacher-classroom') ? 'active' : '' }}">Teacher Classroom</a></li>
                        <li><a href="{{ URL::to('/teacher/teacher-subject') }}" class="{{ request()->is('teacher/teacher-subject') ? 'active' : '' }}">Teacher Subject</a></li>
                        <li><a href="{{ URL::to('/teacher-grade') }}" class="">Grade</a></li> --}}
                    </ul>
                </li>
                <li class="submenu {{ request()->is('teacher/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ URL::to('/teacher/teacher-list') }}" class="{{ request()->is('teacher/teacher-list') ? 'active' : '' }} || {{ request()->is('teacher/teacher-list/add') ? 'active' : '' }}">Teacher List</a></li>
                        <li><a href="{{ URL::to('/teacher/teacher-homeroom') }}" class="{{ request()->is('teacher/teacher-homeroom') ? 'active' : '' }} || {{ request()->is('teacher/teacher-homeroom/add') ? 'active' : '' }}">Teacher Homeroom</a></li>
                        <li><a href="{{ URL::to('/teacher/teacher-classroom') }}" class="{{ request()->is('teacher/teacher-classroom') ? 'active' : '' }}">Teacher Classroom</a></li>
                        <li><a href="{{ URL::to('/teacher/teacher-schedule') }}" class="{{ request()->is('teacher/teacher-schedule') ? 'active' : '' }}">Teacher Schedule</a></li>
                        <li><a href="{{ URL::to('/teacher/teacher-subject') }}" class="{{ request()->is('teacher/teacher-subject') ? 'active' : '' }}">Teacher Subject</a></li>
                        <li><a href="{{ URL::to('/teacher/grade') }}" class="{{ request()->is('teacher/grade') ? 'active' : '' }}">Grade</a></li>
                        <li><a href="{{ URL::to('/teacher/grade-detail') }}" class="{{ request()->is('teacher/grade-detail') ? 'active' : '' }}">Grade Detail</a></li>
                    </ul>
                </li>
                <li class="submenu {{ request()->is('librarian*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-book-reader"></i> <span> Librarians</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ URL::to('librarian/librarian-list') }}" class="{{ request()->is('librarian/librarian-list') ? 'active' : '' }}">Librarian List</a></li>
                        <li><a href="{{ URL::to('librarian/librarian-list/add') }}" class="{{ request()->is('librarian/librarian-list/add') ? 'active' : '' }}">Librarian Add</a></li>
                    </ul>
                </li>
                <li class="submenu {{ request()->is('book*') || request()->is('book-category') || request()->is('book-borrow') || request()->is('book-return') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-book"></i> <span> Library</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ URL::to('/book') }}" class="{{ request()->is('book') ? 'active' : '' }} || {{ request()->is('book/add') ? 'active' : '' }}">Books</a></li>
                        <li><a href="{{ URL::to('/book-category') }}" class="{{ request()->is('book-category') ? 'active' : '' }} || {{ request()->is('book-category/add') ? 'active' : '' }}">Book Category</a></li>
                        <li><a href="{{ URL::to('/book-borrow') }}" class="{{ request()->is('book-borrow') ? 'active' : '' }} || {{ request()->is('book-borrow/create') ? 'active' : '' }} || {{ request()->is('book-borrow/*/edit') ? 'active' : '' }}">Book Borrowing</a></li>
                        <li><a href="{{ URL::to('/book-return') }}" class="{{ request()->is('book-return') ? 'active' : '' }}">Book Returns</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Management</span>
                </li>
                <li class="submenu {{ request()->is('classroom*') || request()->is('subject') || request()->is('attendance') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Classrooms</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ URL::to('classroom/') }}" class="{{ request()->is('classroom') ? 'active' : '' }}">Classroom List</a></li>
                        <li><a href="{{ URL::to('classroom/classroom-type/') }}" class="{{ request()->is('classroom/classroom-type') ? 'active' : '' }}">Classroom Type</a></li>
                        <li><a href="{{ URL::to('/subject') }}" class="{{ request()->is('subject') ? 'active' : '' }}">Subject</a></li>
                        <li><a href="{{ URL::to('attendance') }}" class="{{ request()->is('attendance') ? 'active' : '' }}">Attendances</a></li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('curriculum') ? 'active' : '' }}">
                    <a href="{{ URL::to('/curriculum') }}"><i class="fas fa-school"></i> <span> Curriculums</span></a>
                </li>
                <li class="nav-item {{ request()->is('task-type') ? 'active' : '' }}">
                    <a href="{{ URL::to('/task-type') }}"><i class="fas fa-tags"></i> <span> Task Type</span></a>
                </li>
                <li class="nav-item {{ request()->is('configuration') ? 'active' : '' }}">
                    <a href="{{ URL::to('/configuration') }}"><i class="fas fa-cog"></i> <span> Configuration</span></a>
                </li>
                @if (auth()->user()->role == 'Super Admin')
                <li class="menu-title"><span>Others</span></li>
                {{-- <li class="submenu {{ request()->is('user') || request()->is('forgot-password') || request()->is('error-404') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                    <ul> --}}
                        <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
                            <a href="{{ URL::to('/user') }}" ><i class="fas fa-users"></i> <span> Users</span></a>
                        </li>
                        {{-- <li><a href="forgot-password.html" class="{{ request()->is('forgot-password') ? 'active' : '' }}">Forgot Password</a></li>
                        <li><a href="error-404.html" class="{{ request()->is('error-404') ? 'active' : '' }}">Error Page</a></li>
                    </ul>
                </li> --}}
                @endif
                <li class="nav-item">
                    <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
