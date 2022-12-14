<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
        media="print">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Coffeeup | Print Sales Report</title>
</head>

<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <p align="center" class="h2 font-weight-bold text-lg">Sales Report</p>
                        </div>
                        <div class="card-body">            
                            <table class="table table-bordered table-striped">
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
                                    @foreach ($report as $r)
                                    <tr>
                                        <td>{{ $r ->id }}</td>
                                        <td>{{ $r ->employee_id }}</td>
                                        <td>{{ $r ->order->user_id }}</td>
                                        <td>Rp {{ number_format($r ->order->total, 2, ',', '.')}}</td>
                                        <td>Rp {{ number_format($r ->payment, 2, ',', '.') }}</td>
                                        <td>Rp {{ number_format($r ->change, 2, ',', '.') }}</td>
                                        <td>{{ $r ->order->order_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>