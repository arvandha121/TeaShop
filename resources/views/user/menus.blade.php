@extends('layouts.allMenuLayout')

@section('title', 'Coffeeup | All Menus')

@section('container')
<div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
<section class="menu-area pt-4" id="coffee">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<form action="#" method="GET">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Search . . . " name="query" id="search">
					<button class="btn btn-default" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
				</div>
			</form>
		</div>

		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<div class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
					<span><i class="fa-solid fa-cup-togo"></i></span>
					Beverage
				</div>
			</li>
			<li class="nav-item" role="presentation">
			  <div class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
					Food
			  </div>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<div id="paginate_data">
					@include('user.beverage-paginate')
				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div id="food-menus">
					@include('user.food-paginate')
				</div>
			</div>
			
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade mt-5" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
@endsection

@section('scripts')
	<script>
		$(document).ready( function() {
			// initialize the menu
			getAllMenus();

			const menus = localStorage.getItem("menus");
			var menu = JSON.parse(menus);
			
			var shoppingCart = localStorage.getItem("cart");
			shoppingCart = JSON.parse(shoppingCart);

			if(checkAuth()) {
				// check if there are items in the cart then copy it to db if user confirm
				// ... 


			}
			// console.log(selected);
			if(!localStorage.getItem("cart")) {
				localStorage.setItem("cart", "[]");
			}		

			// cart.push(selected);

			$(document).on('click', '#test', function() {
				var cart = localStorage.getItem("cart");

				cart = JSON.parse(cart);

				console.log(cart);

				for (const key in cart) {
					if (Object.hasOwnProperty.call(cart, key)) {
						const element = cart[key];
						console.log(element.menu.name);
						console.log(element.qty);
					}
				}
			});

			
			// console.log(JSON.parse(menus));
			
			function addToCart(menuId) {
				var selectedMenu = findMenu(menuId);
				var qty = $('#qty').val();

				var cart = {
						menu: selectedMenu,
						qty: qty,
				}

				if(checkAuth()) {					
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
				for(let i = 0; i < menu.length; i++) {
					if(menu[i].id == menuId) {
						return menu[i];
					}
				}
			}

			function checkAuth() {
				var status;
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route("auth.check") }}',
					async: false,
					success: function(data) {
						status = data.status;
					}
				});

				return status;
			}

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

			function getBeverageData(query = '', page) {
				$.ajax({
					type: "GET",
					url: "/all-menus/beverages?page=" + page,
					data: {query:query},
					success: function(data) {					
						$('#paginate_data').html('');	
						$('#paginate_data').html(data);
					}
				});
			}

			function getFoodData(query = '', page) {
				$.ajax({
					type: "GET",
					url: "/all-menus/foods?page=" + page,
					data: {query: query},
					success: function(data) {
						$('#food-menus').html('');
						$('#food-menus').html(data);	
					}
				});
			}

			$(document).on('keyup', '#search', function() {
				var query = $(this).val();				
				
				if ($('#pills-home-tab').hasClass('active')) {
					var page = $('#hidden_page_beverage').val();
					getBeverageData(query, page);
				} else {
					var page = $('#hidden_page_food').val();
					getFoodData(query, page);
				}
			});

			function convertIDR(number) {
				return number.toLocaleString('id-ID', { 
					style: 'currency', 
					currency: 'IDR' 
				});
			}

			$(document).on('click', '.pagination a', function(event) {
				event.preventDefault();
				var page = $(this).attr('href').split('page=')[1];
				var query = $('#query').val();
				

				if ($('#pills-home-tab').hasClass('active')) {
					$('#hidden_page_beverage').val = page;
					getBeverageData(query, page);
				} else {
					$('#hidden_page_food').val = page;
					getFoodData(query, page);
				}				                                                            
			});

			function showModalMenu(id) {
				$.ajax({
					type: 'GET',
					url: '/menu/show/'+id,
					success: function(data) {
						$('.modal-body').html('');
						$('.modal-body').append(
							'<div class="row">\
								<div class="col-md-4">\
									<img src="/storage/' + data.menu.menu_photo_path + '" alt="Menu" width="200px">\
								</div>\
								<div class="col-md-8">\
									<h3 class="fw-bold">'+ data.menu.name + '</h3>\
									<hr>\
									<div class="row mb-2">\
										<h4 class="col-md-6">' + convertIDR(data.menu.price) + '</h4>\
										<h4 class="col-md-6 d-flex justify-content-end">Stock: ' + data.menu.stock + '</h4>\
									</div>\
									<div class="float-none">\
										<span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia laboriosam quaerat vero illum dolorem voluptate!</span>\
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
			
		});

	</script>
@endsection