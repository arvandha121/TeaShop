<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('images/fav.png') }}">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title')</title>

    {{-- csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Title -->
    <title>Coffee</title>


    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
   CSS
   ============================================= -->
    {{--
    <link rel="stylesheet" href="{{asset('assets/css/linearicons.css')}}"> --}}
    {{--
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('additional-css')

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>

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
                        <li class="menu-active"><a href="/">Home</a></li>
                        <li><a href="{{ route('user.menus') }}">Menu</a></li>
                        @guest
                            <li><a id="show-cart" href="{{ route('cart') }}">Show cart</a></li>
                            <li><a href="{{ route('login') }}" style="font-size: 14px; background-color: #b68834;"
                                    class="btn text-white">Login</a></li>
                        @endguest
                        @auth
                            <li class="dropdown show">
                                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu navbar-dropdown col-3" aria-labelledby="dropdownMenuLink">
                                    <div><a class="dropdown-item" style="color: rgb(20, 2, 0);"
                                            href="{{ route('user.profile') }}">Profile</a></div>
                                    <div><a class="dropdown-item" style="color: rgb(20, 2, 0);"
                                            href="{{ route('cart') }}">Chart</a></div>
                                    <div><a class="dropdown-item" style="color: rgb(20, 2, 0);"
                                            href="{{ route('order.all', auth()->user()->id) }}">My Orders</a></div>
                                </div>
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <input class="btn text-white mx-1" style="font-size: 14px; background-color: #b68834;"
                                        type="submit" onclick="confirm('Are you sure want to logout?')" value="Logout">
                                    <input type="hidden" name="id_user" id="id_user" value="{{ auth()->user()->id }}">
                                </form>
                            </li>
                        @endauth
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->

    @yield('container')

    @include('layouts.footer')

    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="../assets/js/easing.min.js"></script>
    <script src="../assets/js/hoverIntent.js"></script>
    <script src="../assets/js/superfish.min.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/parallax.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>
