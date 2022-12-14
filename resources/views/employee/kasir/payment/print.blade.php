<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
    media="print">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Coffeeup | Print Payment</title>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <p align="center" class="h2 font-weight-bold text-lg">Payment Receipt</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover mb-2">
                            <tr>
                                <th>ID Payment</th>
                                <td>{{$payment->id}}</td>
                            </tr>
                            <tr>
                                <th>ID Order</th>
                                <td>{{$payment->order->id}}</td>
                            </tr>
                            <tr>
                                <th>ID Employee</th>
                                <td>{{$payment->employee_id}}</td>
                            </tr>
                            <tr>
                                <th>Buyer Name</th>
                                <td>{{$payment->order->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{$payment->order->order_date}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover mb-4">
                            <tr>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                            @foreach ($payment->order->orderDetail as $orderDetail)
                            <tr>
                                <td>{{ $orderDetail->menu->name }}</td>
                                <td>{{ $orderDetail->qty }}</td>
                                <td>Rp {{
                                    number_format($orderDetail->menu->price * $orderDetail->qty, 2, ',', '.')
                                    }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th></th>
                                <th>Total</th>
                                <td>Rp {{number_format($payment->order->total, 2, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Payment</th>
                                <td>Rp {{number_format($payment->payment, 2, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Change</th>
                                <td>Rp {{number_format($payment->change, 2, ',', '.')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>