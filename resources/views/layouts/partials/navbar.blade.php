<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo font-weight-bold" href="#">Coffeeup</a>
    <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('images/fav.png') }}" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            @if (auth()->user()->profile_path != NULL)
            @php
            $img = auth()->user()->profile_path
            @endphp
            @else
            @php
            $img = 'user_profiles/employee.png'
            @endphp
            @endif
            <img src="{{ asset('storage/'.$img) }}" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">{{auth()->user()->name }}</p>
          </div>
        </a>
        @auth

        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="#">
              <form action="/logout" method="post">
                @csrf
                <i class="mdi mdi-logout me-2 text-primary"></i><input style="border: none;" class="bg-white text-primary" type="submit" value="Logout">
              </form>
            @endauth
            </a>
        </div>
        
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>