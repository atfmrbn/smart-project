<div class="header">
        <div class="header-left">
          <a href="{{ URL::to('/') }}" class="logo">
            <img src="{{ URL::to('assets/img/logo.png') }}"  alt="Logo" />
          </a>
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

          <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
              <span class="user-img">
                <img class="rounded-circle" src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" width="31" alt="Soeng Souy" />
                <div class="user-text">
                  <h6>Soeng Souy</h6>
                  <p class="text-muted mb-0">Administrator</p>
                </div>
              </span>
            </a>
            <div class="dropdown-menu">
              <div class="user-header">
                <div class="avatar avatar-sm">
                  <img src="{{ URL::to('assets/img/profiles/avatar-01.jpg') }}" alt="User Image" class="avatar-img rounded-circle" />
                </div>
                <div class="user-text">
                  <h6>Soeng Souy</h6>
                  <p class="text-muted mb-0">Administrator</p>
                </div>
              </div>
              <a class="dropdown-item" href="profile.html">My Profile</a>
              <a class="dropdown-item" href="inbox.html">Inbox</a>
              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
          </li>
        </ul>
      </div>