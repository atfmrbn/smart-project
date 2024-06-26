<div class="header">
        <div class="header-left">
          <a href="
            @if(Auth::user()->role == 'Super Admin')
              {{ URL::to('dashboard/superAdmin') }}
            @elseif(Auth::user()->role == 'Admin')
              {{ URL::to('dashboard/admin') }}
            @elseif(Auth::user()->role == 'Student')
              {{ URL::to('dashboard/student') }}
            @elseif(Auth::user()->role == 'Teacher')
              {{ URL::to('dashboard/teacher') }}
            @elseif(Auth::user()->role == 'Parent')
              {{ URL::to('dashboard/parent') }}
            @else
              {{ URL::to('dashboard/librarian') }}
            @endif
          " class="logo">
            <img src="https://seeklogo.com/images/S/smarts-logo-8F737FF005-seeklogo.com.png" alt="Logo" />
          </a>
          {{-- <a href="{{ URL::to('/') }}" class="logo">
            <img src="https://seeklogo.com/images/S/smarts-logo-8F737FF005-seeklogo.com.png" alt="Logo" />
          </a> --}}
        </div>

        <div class="menu-toggle">
          <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
          </a>
        </div>

        <a class="mobile_btn" id="mobile_btn">
          <i class="fas fa-bars"></i>
        </a>

        <ul class="nav user-menu">
          <li class="nav-item zoom-screen me-2">
            <a href="#" class="nav-link header-nav-list win-maximize">
              <img src="{{ URL::to('assets/img/icons/header-icon-04.svg') }}" alt="" />
            </a>
          </li>

          {{-- <li class="nav-item new-user-menus">
            <a href="#" class="nav-link" aria-expanded="false">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ asset('images/' . Auth::user()->image) }}" width="31">
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                    </div>
                </span>
            </a>
            {{-- <div class="dropdown-menu dropdown-menu-right">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ asset('images/' . Auth::user()->image) }}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                    </div>
                </div>
                <a class="dropdown-item" href="#">My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div> --}}
            <li class="nav-item dropdown has-arrow new-user-menus">
              <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                  <span class="user-img">
                      <img class="rounded-circle" src="{{ asset('images/' . Auth::user()->image) }}" width="31">
                      <div class="user-text">
                          <h6>{{ Auth::user()->name }}</h6>
                          <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                      </div>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ URL::to('/profile') }}"><i class="fas fa-user"></i> My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </li>
        </ul>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</div>