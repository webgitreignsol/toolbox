<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Dashboard | Will Go Transportation</title>

  <!-- General CSS Files index -->
  <link rel="stylesheet" href="{{ asset('public/assets/admin/css/app.min.css') }}">
  <!-- General CSS Files create-post -->
  <link rel="stylesheet" href="{{ asset('public/assets/admin/bundles/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/admin/bundles/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
  <!-- General CSS Files datatables -->
  <link rel="stylesheet" href="{{ asset('public/assets/admin/bundles/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/admin/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/admin/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/admin/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('public/assets/admin/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href="{{ asset('public/assets/admin/img/favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('public/assets/admin/backend/css/toastr.min.css') }}">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                  collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
                      text-white"> <img alt="image" src="{{ asset('public/assets/admin/img/users/user-1.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">John
                      Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('public/assets/admin/img/users/user-2.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Request for leave
                      application</span>
                    <span class="time">5 Min Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
                        fa-code"></i>
                  </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
                        fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                      Sugiharto</b> are now friends <span class="time">10 Hours
                      Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('public/assets/admin/img/user.png') }}"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title"><b>{{ Auth::user()->name }}</b></div>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" 
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();" 
                 class="dropdown-item has-icon text-danger"> 
                 <i class="fas fa-sign-out-alt"></i>
                  Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#"> <img alt="image" src="{{ asset('public/assets/admin/img/logo.png') }}" class="header-logo" /> <span
                class="logo-name">WillGo</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>

            <li >
              <a href="{{ route('dashboard') }}" ><i data-feather="monitor"></i><span>Dashboard</span></a>
              
            </li>
            
            @if(Gate::check('role-list') || Gate::check('role-create'))
            <li class="dropdown {{ Request::is('admin/roles', 'admin/roles/create') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="anchor"></i><span>Roles</span></a>
              <ul class="dropdown-menu">
                @can('role-list')
                <li class="{{ Request::is('admin/roles') ? 'active' : '' }}"><a class="nav-link" href="{{ route('roles.index') }}">All Roles</a></li>
                @endcan
                @can('role-create')
                <li class="{{ Request::is('admin/roles/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('roles.create') }}">Add Role</a></li>
                @endcan
              </ul>
            </li>
            @endif

            @if(Gate::check('permission-list') || Gate::check('permission-create'))
            <li class="dropdown {{ Request::is('admin/permissions', 'admin/permissions/create') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="activity"></i><span>Permissions</span></a>
              <ul class="dropdown-menu">
                @can('permission-list')
                <li class="{{ Request::is('admin/permissions') ? 'active' : '' }}"><a class="nav-link" href="{{ route('permissions.index') }}">All Permissions</a></li>
                @endcan
                @can('permission-create')
                <li class="{{ Request::is('admin/permissions/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('permissions.create') }}">Add Permission</a></li>
                @endcan
              </ul>
            </li>
            @endif

            @if(Gate::check('user-list') || Gate::check('user-create'))
            <li class="dropdown {{ Request::is('admin/users', 'admin/users/create') ? 'active' : '' }}">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                @can('user-list')
                <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}">All Users</a></li>
                @endcan
                @can('user-create')
                <li class="{{ Request::is('admin/users/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.create') }}">Add User</a></li>
                @endcan
              </ul>
            </li>
            @endif
            @if(Gate::check('driver-list') || Gate::check('driver-create'))
              <li class="dropdown {{ Request::is('admin/drivers', 'admin/drivers/create') ? 'active' : '' }}">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Drivers</span></a>
                  <ul class="dropdown-menu">
                      @can('driver-list')
                          <li class="{{ Request::is('admin/drivers') ? 'active' : '' }}"><a class="nav-link" href="{{ route('drivers.index') }}">All Drivers</a></li>
                      @endcan
                      @can('driver-create')
                          <li class="{{ Request::is('admin/drivers/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('drivers.create') }}">Add Driver</a></li>
                      @endcan
                  </ul>
              </li>
            @endif

            @if(Gate::check('passenger-list') || Gate::check('passenger-create'))
              <li class="dropdown {{ Request::is('admin/passengers', 'admin/passengers/create') ? 'active' : '' }}">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Passengers</span></a>
                  <ul class="dropdown-menu">
                      @can('passenger-list')
                          <li class="{{ Request::is('admin/passengers') ? 'active' : '' }}"><a class="nav-link" href="{{ route('passengers.index') }}">All Passengers</a></li>
                      @endcan
                      @can('passenger-create')
                          <li class="{{ Request::is('admin/passengers/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('passengers.create') }}">Add Passenger</a></li>
                      @endcan
                  </ul>
              </li>
            @endif
             @if(Gate::check('ride-list'))
              <li class="dropdown {{ Request::is('admin/rides','admin/rides/accepted', 'admin/rides/completed', 'admin/rides/cancelled') ? 'active' : '' }}">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="truck"></i><span>Rides Management</span></a>
                  <ul class="dropdown-menu">
                      @can('ride-list')
                          <li class="{{ Request::is('admin/rides') ? 'active' : '' }}"><a class="nav-link" href="{{ route('rides.index') }}">All Rides</a></li>
                      @endcan
                      @can('ride-list')
                          <li class="{{ Request::is('admin/rides/accepted') ? 'active' : '' }}"><a class="nav-link" href="{{ route('rides.accepted') }}">Accepted Rides</a></li>
                      @endcan
                      @can('ride-list')
                          <li class="{{ Request::is('admin/rides/completed') ? 'active' : '' }}"><a class="nav-link" href="{{ route('rides.completed') }}">Completed Rides</a></li>
                      @endcan
                      @can('ride-list')
                          <li class="{{ Request::is('admin/rides/cancelled') ? 'active' : '' }}"><a class="nav-link" href="{{ route('rides.cancelled') }}">Cancelled Rides</a></li>
                      @endcan                     
                  </ul>
              </li>
            @endif
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          <b style="color:#212529;">Copyright © {{ date('Y') }} <a href="https://reignsol.com" target="_blank" style="color:#6777ef; text-decoration:none;"><b>reignsol</b></a>. All rights reserved.</b>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('public/assets/admin/js/app.min.js') }}"></script>
  <!-- JS Libraies index-->
  <script src="{{ asset('public/assets/admin/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- JS Libraies create-post-->
  <script src="{{ asset('public/assets/admin/bundles/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('public/assets/admin/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('public/assets/admin/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
  <script src="{{ asset('public/assets/admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <!-- JS Libraies datatables -->
  <script src="{{ asset('public/assets/admin/bundles/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('public/assets/admin/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('public/assets/admin/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Page Specific JS File index -->
  <script src="{{ asset('public/assets/admin/js/page/index.js') }}"></script>
  <!-- Page Specific JS File create-post -->
  <script src="{{ asset('public/assets/admin/js/page/create-post.js') }}"></script>
  <!-- Page Specific JS File datatables -->
  <script src="{{ asset('public/assets/admin/js/page/datatables.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('public/assets/admin/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('public/assets/admin/js/custom.js') }}"></script>
  <script src="{{ asset('public/assets/admin/backend/js/toastr.min.js') }}"></script>
  {!! Toastr::message() !!}

  <script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error!!', {
      closeButton:true,
      progressBar:true,
    });
    @endforeach
    @endif
  </script>

  @stack('js')

</body>
</html>