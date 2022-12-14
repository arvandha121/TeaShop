<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          @if (auth()->user()->profile_path != NULL)
          @php
          $img = auth()->user()->profile_path
          @endphp
          @else
          @php
          $img = 'user_profiles/employee.png'
          @endphp
          @endif
          <img src="{{ asset('storage/'.$img) }}" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{auth()->user()->name }}</span>
          <span class="text-secondary text-small">{{auth()->user()->role->role_name }}</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item {{ ($title === "employee" ? 'active' : '' )  }}">
      <a class="nav-link" href="{{ route('employee.index') }}">
        <span class="menu-title">Employees Table</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
    <li class="nav-item {{ ($title === "report" ? 'active' : '' )  }}">
      <a class="nav-link" href="{{ route('report.index') }}">
        <span class="menu-title">Sales Report</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>