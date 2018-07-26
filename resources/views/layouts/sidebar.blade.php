<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="nav-icon icon-speedometer"></i> Dashboard
        </a>
      </li>
      <li class="nav-title">Theme</li>
      <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#">
          <i class="nav-icon icon-people"></i> Members</a>
        <ul class="nav-dropdown-items">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('members.index') }}">
              <i class="nav-icon icon-people"></i> Members List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('members.create') }}">
              <i class="nav-icon icon-plus"></i> Add Member</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>