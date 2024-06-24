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
                @if (auth()->user()->role == 'Super Admin')
                    <li class="nav-item {{ request()->is('dashboard/superAdmin') ? 'active' : '' }}">
                        <a href="{{ route('superAdmin.dashboard') }}" class=""><i
                                class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Admin')
                    <li class="nav-item {{ request()->is('dashboard/admin') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}"
                            class="{{ request()->is('dashboard/admin') ? 'active' : '' }}"><i
                                class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Teacher')
                    <li class="nav-item {{ request()->is('dashboard/teacher') ? 'active' : '' }}">
                        <a href="{{ route('teacher.dashboard') }}" class=""><i
                                class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Student')
                    <li class="nav-item {{ request()->is('dashboard/student') ? 'active' : '' }}">
                        <a href="{{ route('student.dashboard') }}" class=""><i
                                class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Librarian')
                    <li class="nav-item {{ request()->is('dashboard/librarian') ? 'active' : '' }}">
                        <a href="{{ route('librarian.dashboard') }}" class=""><i
                                class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                @endif

                @if (auth()->user()->role == 'Parent')
                    <li class="nav-item {{ request()->is('dashboard/parent') ? 'active' : '' }}">
                        <a href="{{ route('parent.dashboard') }}" class=""><i
                                class="feather-grid"></i><span>Dashboard</span></a>
                    </li>
                @endif

                {{-- </ul>
                </li> --}}
                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Student', 'Teacher', 'Parent']))
                    <li
                        class="submenu {{ request()->is('student/*') || request()->is('extracurricular*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                                <li><a href="{{ URL::to('/student/student-list') }}"
                                        class="{{ request()->is('student/student-list') ? 'active' : '' }}">Student
                                        List</a></li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher', 'Student', 'Parent']))
                                <li><a href="{{ URL::to('/student/student-teacher-homeroom') }}"
                                        class="{{ request()->is('student/student-teacher-homeroom') ? 'active' : '' }}">Student
                                        Teacher Homeroom</a></li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Student']))
                                <li><a href="{{ URL::to('/extracurricular') }}"
                                        class="{{ request()->is('extracurricular') ? 'active' : '' }}">Extracurricular
                                        Activities</a></li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher', 'Student', 'Parent']))
                                <li><a href="{{ URL::to('/extracurricular-student') }}"
                                        class="{{ request()->is('extracurricular-student') ? 'active' : '' }}">Extracurricular
                                        Participants</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                    <li class="submenu {{ request()->is('parent/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-user"></i> <span> Parents</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ URL::to('/parent/parent-list') }}"
                                    class="{{ request()->is('parent/parent-list') ? 'active' : '' }} || {{ request()->is('parent/parent-list/create') ? 'active' : '' }} || {{ request()->is('parent/parent-list/*/edit') ? 'active' : '' }} || {{ request()->is('parent/parent-list/*') ? 'active' : '' }}">Parents
                                    List</a></li>
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher', 'Student']))
                    <li class="submenu {{ request()->is('teacher/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                                <li>
                                    <a href="{{ URL::to('/teacher/teacher-list') }}"
                                        class="{{ request()->is('teacher/teacher-list') ? 'active' : '' }} || {{ request()->is('teacher/teacher-list/add') ? 'active' : '' }}">Teacher
                                        List</a>
                                </li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher', 'Student']))
                                <li>
                                    <a href="{{ URL::to('/teacher/teacher-homeroom') }}"
                                        class="{{ request()->is('teacher/teacher-homeroom') ? 'active' : '' }} || {{ request()->is('teacher/teacher-homeroom/add') ? 'active' : '' }} || {{ request()->is('teacher/teacher-homeroom/*/edit') ? 'active' : '' }}">Teacher
                                        Homeroom
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/teacher/teacher-classroom') }}"
                                        class="{{ request()->is('teacher/teacher-classroom') ? 'active' : '' }} || {{ request()->is('teacher/teacher-classroom/create') ? 'active' : '' }} || {{ request()->is('teacher/teacher-classroom/*/edit') ? 'active' : '' }}">Teacher
                                        Classroom
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/teacher/teacher-schedule') }}"
                                        class="{{ request()->is('teacher/teacher-schedule') ? 'active' : '' }} || {{ request()->is('teacher/teacher-schedule/create') ? 'active' : '' }} || {{ request()->is('teacher/teacher-schedule/*/edit') ? 'active' : '' }}">Teacher
                                        Schedule
                                    </a>
                                </li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher']))
                                <li>
                                    <a href="{{ URL::to('/teacher/teacher-subject') }}"
                                        class="{{ request()->is('teacher/teacher-subject') || request()->is('teacher/teacher-subject/create') || request()->is('teacher/teacher-subject/*/edit') ? 'active' : '' }}">
                                        Teacher Subject
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/task-type') }}"
                                        class="{{ request()->is('task-type') || request()->is('task-type/create') ? 'active' : '' }}">
                                        Task Type
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/teacher/grade') }}"
                                        class="{{ request()->is('teacher/grade') ? 'active' : '' }}">
                                        Grade
                                    </a>
                                </li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher', 'Student']))
                                <li>
                                    <a href="{{ URL::to('/teacher/grade-detail') }}"
                                        class="{{ request()->is('teacher/grade-detail') ? 'active' : '' }} || {{ request()->is('teacher/grade-detail/create') ? 'active' : '' }} || {{ request()->is('teacher/grade-detail/*/edit') ? 'active' : '' }}">Grade
                                        Detail</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role, ['Super Admin', 'Librarian']))
                    <li class="submenu {{ request()->is('librarian*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-book-reader"></i> <span> Librarians</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ URL::to('librarian/librarian-list') }}"
                                    class="{{ request()->is('librarian/librarian-list') ? 'active' : '' }}">Librarian
                                    List</a>
                            </li>
                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                                <li><a href="{{ URL::to('librarian/librarian-list/add') }}"
                                        class="{{ request()->is('librarian/librarian-list/add') ? 'active' : '' }}">Librarian
                                        Add</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role, ['Super Admin',  'Librarian', 'Student', 'Teacher']))
                    <li
                        class="submenu {{ request()->is('book*') || request()->is('book-category') || request()->is('book-borrow') || request()->is('book-return') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-book"></i> <span> Library</span> <span
                                class="menu-arrow"></span>
                        </a>
                        <ul>
                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Librarian', 'Student', 'Teacher']))
                                <li><a href="{{ URL::to('/book') }}"
                                        class="{{ request()->is('book') ? 'active' : '' }} || {{ request()->is('book/add') ? 'active' : '' }}">Books</a>
                                </li>
                                <li><a href="{{ URL::to('/book-category') }}"
                                        class="{{ request()->is('book-category') ? 'active' : '' }} || {{ request()->is('book-category/add') ? 'active' : '' }}">Book
                                        Category</a></li>
                            @endif

                            @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Librarian']))
                                <li><a href="{{ URL::to('/book-borrow') }}"
                                        class="{{ request()->is('book-borrow') ? 'active' : '' }} || {{ request()->is('book-borrow/create') ? 'active' : '' }} || {{ request()->is('book-borrow/*/edit') ? 'active' : '' }}">Book
                                        Borrowing</a></li>
                                <li><a href="{{ URL::to('/book-return') }}"
                                        class="{{ request()->is('book-return') ? 'active' : '' }}">Book Returns</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Student', 'Teacher']))
                    <li class="menu-title">
                        <span>Management</span>
                    </li>
                    @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher']))
                        <li
                            class="submenu {{ request()->is('classroom*') || request()->is('subject') || request()->is('attendance') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Classrooms</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ URL::to('classroom/') }}"
                                        class="{{ request()->is('classroom') ? 'active' : '' }} || {{ request()->is('classroom/create') ? 'active' : '' }} || {{ request()->is('classroom/') ? 'active' : '' }}">Classroom
                                        List</a>
                                </li>
                                <li><a href="{{ URL::to('classroom/classroom-type/') }}"
                                        class="{{ request()->is('classroom/classroom-type') ? 'active' : '' }} || {{ request()->is('classroom/classroom-type/create') ? 'active' : '' }} || {{ request()->is('classroom/classroom-type/*') ? 'active' : '' }}">Classroom
                                        Type</a>
                                </li>
                                <li><a href="{{ URL::to('/subject') }}"
                                        class="{{ request()->is('subject') ? 'active' : '' }} || {{ request()->is('subject/create') ? 'active' : '' }} || {{ request()->is('subject/*/edit') ? 'active' : '' }} || {{ request()->is('subject/*') ? 'active' : '' }}">Subject</a>
                                </li>

                                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher']))
                                    <li><a href="{{ URL::to('attendance') }}"
                                            class="{{ request()->is('attendance') ? 'active' : '' }}">Attendances</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->role, ['Super Admin']))
                        <li class="nav-item {{ request()->is('curriculum') ? 'active' : '' }}">
                            <a href="{{ URL::to('/curriculum') }}"><i class="fas fa-school"></i> <span>
                                    Curriculums</span></a>
                        </li>
                    @endif
                    @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                        <li
                            class="nav-item {{ request()->is('tuition-type') ? 'active' : '' }} || {{ request()->is('tuition-type/create') ? 'active' : '' }} || {{ request()->is('tuition-type/*/edit') ? 'active' : '' }}">
                            <a href="{{ URL::to('/tuition-type') }}"><i class="fas fa-file-invoice-dollar"></i>
                                <span> Tuition Type</span></a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Student']))
                        <li
                            class="nav-item {{ request()->is('tuition') ? 'active' : '' }} || {{ request()->is('tuition/create') ? 'active' : '' }} || {{ request()->is('tuition/*/edit') ? 'active' : '' }}">
                            <a href="{{ URL::to('/tuition') }}"><i class="fas fa-money-bill-wave"></i> <span>
                                    Tuition</span></a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->role, ['Super Admin']))
                        <li class="nav-item {{ request()->is('configuration') ? 'active' : '' }}">
                            <a href="{{ URL::to('/configuration') }}"><i class="fas fa-cog"></i> <span>
                                    Configuration</span></a>
                        </li>
                    @endif
                @endif

                @if (auth()->user()->role == 'Super Admin')
                    <li class="menu-title"><span>Others</span></li>
                    {{-- <li class="submenu {{ request()->is('user') || request()->is('forgot-password') || request()->is('error-404') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                    <ul> --}}
                    <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
                        <a href="{{ URL::to('/user') }}"><i class="fas fa-users"></i> <span> Users</span></a>
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
