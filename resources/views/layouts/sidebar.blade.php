
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AKitu Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AKitu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/Logo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if(Route::has('login'))
               @auth
                   @if(Auth::user()->utype === 'SADM')
          <li class="nav-item">
            <a href="{{route('inbox')}}" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Chat
              </p>
            </a>
          </li>

          @elseif(Auth::user()->utype === 'ADM' && Auth::user()->department === 'AND')
             @include('layouts.admin.sidebar-android')

          @elseif(Auth::user()->utype === 'ADM' && Auth::user()->department === 'FRO')
          @include('layouts.admin.sidebar-front')


          @elseif(Auth::user()->utype === 'ADM' && Auth::user()->department === 'BAC')
          @include('layouts.admin.sidebar-back')

          @elseif(Auth::user()->utype === 'USR' && Auth::user()->department === 'AND')
          @include('layouts.user.sidebar-android')


          @elseif(Auth::user()->utype === 'USR' && Auth::user()->department === 'FRO')

          @include('layouts.user.sidebar-front')

          @elseif(Auth::user()->utype === 'USR' && Auth::user()->department === 'BAC')
          @include('layouts.user.sidebar-back')



              @endif
              @endauth
              @endif



          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Log out</p>
            </a>
            <form id="logout-form" method="POST" action="{{route('logout')}}">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
