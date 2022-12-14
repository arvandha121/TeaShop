<header id="header" id="home">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
                    <ul>
                        <li>
                            Mon-Fri: 8am to 2pm
                        </li>
                        <li>
                            Sat-Sun: 11am to 4pm
                        </li>
                        <li>
                            <a href="tel:(012) 6985 236 7512">(012) 6985 236 7512</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="#"><img src="img/logo.png" alt="" title="" /></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('user.menus') }}">Menu</a></li>
                    @guest
                    <li><a id="show-cart" href="{{ route('cart') }}">Show cart</a></li>
                    <li><a href="{{ route('login') }}" class="btn text-white" style="font-size: 14px; background-color: #b68834;">Login</a></li>
                    @endguest
                    @auth
                    <li class="dropdown show">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu navbar-dropdown col-3" aria-labelledby="dropdownMenuLink">
                            <div><a class="dropdown-item" style="color: rgb(20, 2, 0);" href="{{ route('user.profile') }}">Profile</a></div>
                            <div><a class="dropdown-item" style="color: rgb(20, 2, 0);" href="{{ route('cart') }}">Chart</a></div>
                            <div><a class="dropdown-item" style="color: rgb(20, 2, 0);"
                                    href="{{ route('order.all',  auth()->user()->id) }}">My Orders</a></div>
                        </div>
                    </li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <input class="btn text-white mx-1" style="font-size: 14px; background-color: #b68834;" type="submit" onclick="confirm('Are you sure want to logout?')"
                                value="Logout">
                            <input type="hidden" name="id_user" id="id_user" value="{{ auth()->user()->id }}">
                        </form>
                    </li>
                    @endauth
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->