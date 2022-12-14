@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Detail Payment')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('payment.index') }}">Payment / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Detail Payment</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover mb-2">
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
                                <th>Email User</th>
                                <td>{{$payment->order->user->email}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{$payment->order->order_date}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover mb-4">
                            <tr>
                                <th>Nama menu</th>
                                <th>QTY</th>
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
                        <div class="d-flex">
                            <a class="btn btn-success mt-3" href="{{ route('payment.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection