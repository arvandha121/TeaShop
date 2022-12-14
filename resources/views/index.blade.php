@extends('layouts.masterLayout')

@section('title', 'Pizzy | Home')

@section('additional-css')
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
@endsection

@section('container')

    <!-- start banner Area -->
    <section class="banner-area" id="home">
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-start">
                <div class="banner-content col-lg-7">
                    <h6 class="text-white text-uppercase">Now you can feel the Energy</h6>
                    <h1>
                        Start your day with <br>
                        a Pizza
                    </h1>
                    <a href="{{ route('user.menus') }}" class="primary-btn text-uppercase">Buy Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start gallery Area -->
    <section class="gallery-area section-gap" id="gallery">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10">What kind of pizza we serve for you</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <a href="../assets/img/g1.jpg" class="img-pop-home">
                        <img class="img-fluid" src="../assets/img/j3.jpg" alt="">
                    </a>
                    <a href="../assets/img/g2.jpg" class="img-pop-home">
                        <img class="img-fluid" src="../assets/img/j2.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-8">
                    <a href="../assets/img/g3.jpg" class="img-pop-home">
                        <img class="img-fluid" src="../assets/img/j1.jpg" alt="">
                    </a>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="../assets/img/g4.jpg" class="img-pop-home">
                                <img class="img-fluid" src="../assets/img/j4.jpg" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <a href="../assets/img/g5.jpg" class="img-pop-home">
                                <img class="img-fluid" src="../assets/img/j5.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End gallery Area -->

    <!-- Start review Area -->
    <section class="review-area section-gap" id="review">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10">What kind of pizza we serve for you</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 single-review">
                    <img src="../assets/img/r1.png" alt="">
                    <div class="title d-flex flex-row">
                        <h4>Fast Serve</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        A pizzahouse, pizza shop, or café is an establishment that primarily serves pizza of various
                        types, e.g. espresso,
                        latte, and cappuccino. Some pizzahouses may serve cold drinks, such as iced pizza, iced tea, and
                        other non-caffeinated
                        beverages
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 single-review">
                    <img src="../assets/img/r2.png" alt="">
                    <div class="title d-flex flex-row">
                        <h4>Fast Order</h4>
                        <div class="star">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                    <p>
                        A pizzahouse, pizza shop, or café is an establishment that primarily serves pizza of various
                        types, e.g. espresso,
                        latte, and cappuccino. Some pizzahouses may serve cold drinks, such as iced pizza, iced tea, and
                        other non-caffeinated
                        beverages
                    </p>
                </div>
            </div>
            <div class="row counter-row">
                <div class="col-lg-3 col-md-6 single-counter">
                    <h1 class="counter">2536</h1>
                    <p>Happy Customers</p>
                </div>
                <div class="col-lg-3 col-md-6 single-counter">
                    <h1 class="counter">7562</h1>
                    <p>Total Customers</p>
                </div>
                <div class="col-lg-3 col-md-6 single-counter">
                    <h1 class="counter">3013</h1>
                    <p>Cups pizza</p>
                </div>
                <div class="col-lg-3 col-md-6 single-counter">
                    <h1 class="counter">10536</h1>
                    <p>Total Orders</p>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade mt-5" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mb-2">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End review Area -->

@endsection

@section('scripts')
    <script>
        function getAllMenus() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/all-menus/fetch-all",
                success: function(data) {
                    localStorage.setItem("menus", JSON.stringify(data.menus));
                }
            });
        }

        function convertIDR(number) {
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
        }

        function showModalMenu(id) {
            $.ajax({
                type: 'GET',
                url: '/menu/show/' + id,
                success: function(data) {
                    console.log(data.menu);
                    $('.modal-body').html('');
                    $('.modal-body').append(
                        '<div class="row">\
    							<div class="col-md-4">\
    								<img src="/storage/' + data.menu.menu_photo_path + '" alt="Menu" width="200px">\
    							</div>\
    							<div class="col-md-8">\
    								<h3 class="fw-bold">' + data.menu.name + '</h3>\
    								<hr>\
    								<div class="row mb-2 ">\
    									<h4 class="col-md-6 text-dark">' + convertIDR(data.menu.price) + '</h4>\
    									<h4 class="col-md-6 d-flex justify-content-end text-dark">Stock: ' + data.menu.stock + '</h4>\
    								</div>\
    								<div class="float-none">\
    									<span class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia laboriosam quaerat vero illum dolorem voluptate!</span>\
    								</div>\
    								<div class="d-flex mt-4">\
    									<button class="btn"><i class="fa-solid fa-minus"></i></button>\
    									<input class="form-control" type="number" name="qty" id="qty">\
    									<input type="hidden" name="hidden_id" id="hidden_id" value="' + data.menu.id + '">\
    									<button class="btn mr-3"><i class="fa-solid fa-plus"></i></button>\
    									<button class="btn btn-warning rounded-3 col-sm-8" id="add-cart"><i class="fa-solid fa-cart-plus"></i></button>\
    								</div>\
    							</div>\
    						</div>'
                    );

                    $('#staticBackdrop').modal('show');
                }
            });
        }

        function addToCart(menuId) {
            var selectedMenu = findMenu(menuId);
            var qty = $('#qty').val();

            var cart = {
                menu: selectedMenu,
                qty: qty,
            }

            if (checkAuth()) {
                var data = {
                    'user_id': $('#id_user').val(),
                    'menu_id': menuId,
                    'qty': qty,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/cart/add",
                    data: data,
                    success: function(response) {
                        console.log(response);
                    }
                });
            } else {
                var shoppingCart = localStorage.getItem("cart");

                shoppingCart = JSON.parse(shoppingCart);
                shoppingCart.push(cart);
                localStorage.setItem("cart", JSON.stringify(shoppingCart));
            }
        }

        function findMenu(menuId) {
            for (let i = 0; i < menu.length; i++) {
                if (menu[i].id == menuId) {
                    return menu[i];
                }
            }
        }

        function checkAuth() {
            var status;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('auth.check') }}',
                async: false,
                success: function(data) {
                    status = data.status;
                }
            });

            return status;
        }

        getAllMenus();

        const menus = localStorage.getItem("menus");
        var menu = JSON.parse(menus);

        var shoppingCart = localStorage.getItem("cart");
        shoppingCart = JSON.parse(shoppingCart);

        if (checkAuth()) {
            // check if there are items in the cart then copy it to db if user confirm
            // ...


        }
        // console.log(selected);
        if (!localStorage.getItem("cart")) {
            localStorage.setItem("cart", "[]");
        }

        $(document).on('click', '.menu', function() {
            var data = $(this).data('menuid');
            showModalMenu(data);
            console.log(data);
        });

        $(document).on('click', '#add-cart', function() {
            var id = $('#hidden_id').val();
            addToCart(id);
            setTimeout(() => {
                alert('item added to cart');
            }, 2000);

            $('#staticBackdrop').modal('hide');
        });
    </script>
@endsection
