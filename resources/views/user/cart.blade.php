@extends('layouts.masterLayout')

@section('title', 'Coffeeup | Shopping Chart')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

@section('container')

<section class="menu-area" id="coffee">
    @auth
    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">    
    @endauth
    <div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg  md:max-w-5xl">
            <div class="md:flex ">
                <div class="w-full p-4 px-5">
                    <div class="md:grid md:grid-cols-12 gap-2 ">
                        <div class="col-span-12 p-5">
                            <button class="btn px-3"
                                style="color:white; background-color: rgb(20, 2, 0); border-radius: 15px; margin-left:85%;">
                                <a class="text-md font-medium mr-2 text-white"
                                    href="{{ route('user.menus') }}">Back
                                </a>
                                <i class="fa fa-arrow-right text-sm pr-2"></i>
                            </button>
                            <h1 class="text-xl font-bold text-gray-800">Shopping Chart</h1>
                            <div class="flex justify-between items-center mt-6 pt-3">
                                <div class="flex  items-center">
                                </div>
                                <div class="flex justify-center items-center">
                                    <div class="pr-8 ">
                                        <span class="text-lg font-medium text-gray-800 font-bold">Subtotal</span>
                                    </div>
                                </div>
                            </div>

                            <div id="items">

                            </div>

                            <div>
                                <div class="flex justify-between items-center mt-3 pt-3">
                                    <button class="btn px-5 py-1 text-lg font-bold" name="bayarchart" id="order"
                                        style="background-color: #b68834; color:white; border-radius: 15px;">Pay Now
                                    </button>
                                    <div class="flex justify-center items-end mr-5">
                                        <span class="text-lg font-medium text-gray-800 mr-3">Total : </span>
                                        <span class="text-lg font-bold text-gray-800 " id="total"> 
                                        </span>
                                        <input type="hidden" name="total" value="333">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var carts;
        var total;

        var status = checkAuth();

        if(status) {   
            console.log('login');
            var temp = [];         
            carts = fetch();
            // console.log(temp);
            // carts = temp;
            console.log(carts);
        } else {
            console.log('meh');
            carts = localStorage.getItem("cart");

            carts = JSON.parse(carts);
        }
        
        showItems(carts);

        function fetch() {
            var newCart;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/fetch",
                data: {user_id: $('#user_id').val()},
                async: false,
                success: function(response) {
                   newCart = response.carts;
                }
            });
            return newCart;            
        }

        function checkAuth() {
            var status;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route("auth.check") }}',
                async: false,
                success: function(response) {
                    status = response.status;
                }
            });

            return status;
        }

        function showItems(carts) {
            $('#items').html('');
            $('#total').text('');

            total = 0;

            for (const key in carts) {
                if (Object.hasOwnProperty.call(carts, key)) {
                    const element = carts[key];

                    var id;

                    if(status) {
                        id = element.id;
                    } else {
                        id = element.menu.id;
                    }
                    
                    total += (element.menu.price * element.qty);
                    $('#items').append(
                        '<div class="flex justify-between items-center mb-3 pt-3 pb-3 border-b">\
                            <div class="flex ml-5 items-center">\
                                <img src="/storage/' + element.menu.menu_photo_path + '" width="100" class="rounded-full mr-5">\
                                <div class="flex flex-col ml-3">\
                                    <span class="md:text-lg font-medium">' + element.menu.name + '</span>\
                                    <span class="text-s text-gray-400">' + convertIDR(element.menu.price) + '</span>\
                                    <span class="text-s text-gray-400">Qty : ' + element.qty + '</span>\
                                </div>\
                            </div>\
                            <div class="flex justify-center items-center mr-5">\
                                <div class="pr-8 ">\
                                    <span class="text-lg font-medium">' + convertIDR(element.menu.price * element.qty) + '</span>\
                                </div>\
                                <div>\
                                    <button id="remove-item" data-menuid="' + id + '"><i class="fa fa-close text-xs font-medium"></i></button>\
                                </div>\
                            </div>\
                        </div>'
                    );
                    // if(status) {
                    //     $('#cart_id').val(element.id);
                    // }
                    console.log(id);
                }
            }

            $('#total').text(convertIDR(total));
        }        

        function convertIDR(number) {
            return number.toLocaleString('id-ID', { 
                style: 'currency', 
                currency: 'IDR' 
            });
        }

        function orders(userId) {
            // store to orders and order details 
            // orders need {id_user, total, order_date}
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/order/add/" + userId,
                data: {
                    user_id: userId,
                    total: total,
                },
                success: function(response) {
                    console.log(response);
                    if(response.odCode == 200) {
                        removeAllItems(userId);
                        stockReduction(response.order_id);
                        window.location.href = "/order/show/" + response.order_id;
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    if(errorThrown == "Forbidden") {
                        window.location.href = "{{route('verification.notice')}}";
                    }
                },
            });
        }

        function removeAllItems(userId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/cart/deletes/" + userId,
                async: false,
                data: {
                    user_id: userId,
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }

        function removeItem(menuId) {
            if(status) {
                console.log('remove item from db');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/cart/delete/" + menuId,
                    data: {
                        cart_id: menuId
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });

                var carts = fetch();

                showItems(carts);
            } else {
                var carts = localStorage.getItem("cart");
                carts = JSON.parse(carts);

                let tempCart = [];
                
                tempCart = carts.filter(function(value, index, arr) {
                    return value.menu.id != menuId;
                });
                
                localStorage.setItem("cart", "[]");
                localStorage.setItem("cart", JSON.stringify(tempCart));

                showItems(tempCart);
            }
            
        }

        function stockReduction(order_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'order/menu/update/' + order_id,
                type: 'PUT',
                async: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }

        $(document).on('click', '#remove-item', function() {
            let menu_id = $(this).data('menuid');
            // console.log( $('#cart_id'));
            // let cart_id = $('#cart_id').val();
            // console.log(cart_id);
            // let id = (status == true) ? cart_id : menu_id ;
            // console.log(id);
            removeItem(menu_id);            
        });

        $(document).on('click', '#order', function(event) {
            event.preventDefault();
            var carts;
            if(status) {
                carts = fetch();

            } else {
                carts = localStorage.getItem("cart");

                carts = JSON.parse(carts);
            }

            let id = $('#user_id').val();
            if(id == undefined) {
                alert('You should login first');
                window.location.href = "/login";
            }

            if(carts.length < 1) {
                alert('cannot checkout, please add item(s) to yor cart!');
            } else {
                orders(id);
            }

        });

    });
    
</script>
@endsection