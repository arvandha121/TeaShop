@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Add Payment')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('payment.index') }}">Payment</a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Add Payment</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div class="d-flex flex-column justify-content-center">
                            <h3 class="text-center mb-3">Scann order token here</h3><br>
                            <div style="width: 400px" id="reader" class="m-auto"></div>
                        </div>

                        <div class="card" id="orderDetail">

                        </div>

                        <form method="post" action="{{ route('payment.store') }}" id="myForm"
                            enctype="multipart/form-data" hidden>
                            @csrf
                            <input type="hidden" name="employee_id" class="form-control" id="employee_id"
                                aria-describedby="employee_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="order" id="order_id" value="">
                            <div class="form-group">
                                <label for="payment">Payment</label>
                                <input type="number" name="payment" class="form-control" id="payment"
                                    aria-describedby="payment">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function convertIDR(number) {
                return number.toLocaleString('id-ID', { 
                    style: 'currency', 
                    currency: 'IDR' 
                });
            }

            function fetchOrderByToken(token) {
                var orderData;
                $.ajax({
                    url: "/employee/kasir/payment/order/" + token,
                    method: "GET",
                    async: false,
                    success: function(response) {   
                        if(response.code == 200) {
                            orderData = response.orders;
                        } else {
                            orderData = {};
                        }
                    }
                });
                return orderData;
            }

            function showOrderData(order) {
                $('#orderDetail').html('');
                $('#orderDetail').append(
                    '<div class="card-header">Order Detail</div>\
                    <div class="card-body">\
                        <table class="table table-striped table-hover mb-2">\
                            <tr>\
                                <th>ID Order</th>\
                                <td>' + order.id + '</td>\
                            </tr>\
                            <tr>\
                                <th>Nama User</th>\
                                <td>' + order.user.name + '</td>\
                            </tr>\
                            <tr>\
                                <th>Order Date</th>\
                                <td>' + order.order_date + '</td>\
                            </tr>\
                        </table>\
                    </div>\
                    <div class="card-body">\
                        <table class="table table-striped table-hover mb-4" id="od-loop">\
                            <tr>\
                                <th>Nama menu</th>\
                                <th>QTY</th>\
                                <th>Subtotal</th>\
                            </tr>\
                        </table>\
                    </div>'
                );
                    
                for (const key in order.order_detail) {
                    if (Object.hasOwnProperty.call(order.order_detail, key)) {
                        const element = order.order_detail[key];
                        
                        $('#od-loop').append(
                           '<tr>\
                                <td> ' + element.menu.name + ' </td>\
                                <td>' + element.qty + '</td>\
                                <td>' + convertIDR(element.menu.price * element.qty) + '</td>\
                            </tr>'
                            
                        );
                    }
                }

                $('#od-loop').append(
                    '<tr>\
                        <th></th>\
                        <th>Total</th>\
                        <td>' + convertIDR(order.total) + '</td>\
                    </tr>'
                );
            }

            

            function onScanSuccess(decodedText, decodedResult) {
                // Handle on success condition with the decoded text or result.
                var order = fetchOrderByToken(decodedText);
                // console.log(Object.keys(order));
                if (Object.keys(order).length > 0) {
                    html5QrcodeScanner.clear();
                    
                    if(order.status == 0) {
                        console.log(order.order_detail);
                    
                        showOrderData(order);

                        $('#myForm').removeAttr('hidden');

                        $('#order_id').val(order.id);
                        // console.log($('#order_id').val());

                    } else {
                        alert('payment done');
                        location.reload();
                    }                    
                    
                } else {
                    console.log('aw');
                }
            }            

            var orderData = [];
            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 });

            html5QrcodeScanner.render(onScanSuccess);
                // $('#myForm').hide();
            
            // showOrderData(orderData);

            $(document).on('click', '#btn', function() {
                html5QrcodeScanner.render(onScanSuccess);
            });
        });

       
    
    </script>
@endsection