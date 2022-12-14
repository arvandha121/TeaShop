@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Sales Report')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Sales Reports Table </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left my-2">
                            <a class="btn btn-primary" href="{{ route('print') }}">Print</a>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Payment</th>
                                    <th>ID Employee</th>
                                    <th>ID Buyer</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Change</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paginate as $report)
                                <tr>
                                    <td>{{ $report ->id }}</td>
                                    <td>{{ $report ->employee_id }}</td>
                                    <td>{{ $report ->order->user_id }}</td>
                                    <td>Rp {{ number_format($report ->order->total, 2, ',', '.')}}</td>
                                    <td>Rp {{ number_format($report ->payment, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($report ->change, 2, ',', '.') }}</td>
                                    <td>{{ $report ->order->order_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="btn">
                        {{ $paginate->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection