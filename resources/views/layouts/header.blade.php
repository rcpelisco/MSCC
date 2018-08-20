<header class="app-header navbar">
  <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
    <img class="navbar-brand-full" src="/images/brand/logo.svg" width="89" height="25" alt="CoreUI Logo">
    <img class="navbar-brand-minimized" src="/images/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
  </a>
  <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  {{-- <ul class="nav navbar-nav d-md-down-none">
    <li class="nav-item px-3">
      <a class="nav-link" href="#">Dashboard</a>
    </li>
    <li class="nav-item px-3">
      <a class="nav-link" href="#">Users</a>
    </li>
    <li class="nav-item px-3">
      <a class="nav-link" href="#">Settings</a>
    </li>
  </ul> --}}
  <ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img class="img-avatar" src="/images/avatars/6.jpg" alt="admin@bootstrapmaster.com">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
          <strong>Settings</strong>
        </div>
        <a class="dropdown-item" href="{{ route('app.update') }}">
          <i class="fa fa-download"></i> Update App</a>
        {{-- <a class="dropdown-item" href="{{ route('database.restore') }}">
          <i class="fa fa-retweet"></i> Restore Database</a>
        <a class="dropdown-item" href="{{ route('database.dump') }}">
          <i class="fa fa-floppy-o"></i> Back up Database</a>
      </div> --}}
    </li>
  </ul>
  <div style="width: 2em"></div>
</header>