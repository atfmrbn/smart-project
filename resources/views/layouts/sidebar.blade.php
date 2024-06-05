<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="menu-title">
          <span>Main Menu</span>
        </li>
        <li class="submenu">
          <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a href="{{ URL::to('/') }}" class="">Admin Dashboard</a></li>
            <li><a href="{{ route('teacher.dashboard') }}" class="">Teacher Dashboard</a></li>
            <li><a href="student-dashboard.html">Student Dashboard</a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a href="{{ URL::to('/student/student-list') }}">Student List</a></li>
            <li><a href="{{ URL::to('/student/student-teacher-homeroom') }}">Student Teacher Homeroom</a></li>
            <li><a href="{{ URL::to('/extracurricular') }}">Extracurricular Activities</a></li>
            <li><a href="{{ URL::to('/extracurricular-student') }}">Extracurricular Participants</a></li>
            {{-- <li><a href="add-student.html">Student Add</a></li>
            <li><a href="edit-student.html">Student Edit</a></li> --}}
          </ul>
        </li>
        <li class="submenu">
          <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a href="{{ URL::to('/teacher/teacher-list') }}" class="">Teacher List</a></li>
            <li><a href="{{ URL::to('/teacher/teacher-homeroom') }}">Teacher Homeroom</a></li>
            <li><a href="{{ URL::to('/teacher/teacher-classroom') }}" class="">Teacher Classroom</a></li>
            <li><a href="{{ URL::to('/teacher/teacher-subject') }}" class="">Teacher Subject</a></li>
          </ul>
        </li>
        <li class="submenu">
            <a href="#"><i class="fas fa-book-reader"></i> <span> Librarians</span> <span class="menu-arrow"></span></a>
            <ul>
                <li><a href="{{ route('librarian.index') }}">Librarian List</a></li>
                <li><a href="{{ route('librarian.create') }}">Librarian Add</a></li>
            </ul>
        </li>

        <li class="submenu">
          <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Classrooms</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a href="{{ URL::to('classroom/') }}">Classroom List</a></li>
            <li><a href="{{ URL::to('classroom/classroom-type/') }}" class="">Classroom Type</a></li>
            <li><a href="{{ URL::to('/subject') }}">Subject</a></li>
            <li><a href="edit-teacher.html">Attendances</a></li>
          </ul>
        </li>

        <li class="nav-item">
            <a href="{{ URL::to('/curriculum') }}"><i class="fas fa-school"></i> <span> Curriculums</span></a>
        </li>

        <li class="nav-item">
          <a href="{{ URL :: to ('/task-type') }}"><i class="fas fa-tags"></i> <span> Task Type</span></a>
      </li>

        <li class="submenu">
          <a href="#"><i class="fas fa-book"></i> <span> Library</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a href="{{ URL::to('/book') }}" class="">Books</a></li>
            <li><a href="{{ URL::to('/book-category') }}" class="">Book Category</a></li>
            <li><a href="{{ URL::to('/book-borrow') }}">Book Borrowing</a></li>
            <li><a href="{{ URL::to('/book-return') }}">Book Returns</a></li>
            <li><a href="edit-teacher.html">Reports</a></li>
          </ul>
        </li>

        <li class="menu-title"><span>Pages</span></li>
        {{-- @if (auth()->user()->role == 'Super Admin') --}}
        <li class="submenu">
            <a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
            <ul>
              <li><a href="{{ URL::to('/user') }}">Users</a></li>
              <li><a href="forgot-password.html">Forgot Password</a></li>
              <li><a href="error-404.html">Error Page</a></li>
            </ul>
          </li>
          {{-- @endif --}}
          <li><a href="{{ route('logout') }}">Logout</a></li>
      </ul>
    </div>
  </div>
</div>
