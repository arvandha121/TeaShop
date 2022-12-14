@extends('layouts.masterLayout')

@section('title', 'Coffeeup | My Orders')

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
    integrity="sha256-3sPp8BkKUE7QyPSl6VfBByBroQbKxKG7tsusY2mhbVY=" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('css/ordersStyle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

@section('container')

<section class="menu-area" id="coffee">
    <div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-10 mx-auto mb-4">
            <div class="section-title text-center ">
                <h2 class="top-c-sep">My Orders</h2>
                <p>This page show all of your orders using this account. It's also contains your payment history.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="career-search mb-60">
                <div class="filter-result">

                    @foreach ($orders as $order)
                    <div class="job-box d-md-flex align-items-center justify-content-between mb-30 bg-white"
                        onclick="window.location.href = '/order/show/' + '{{$order->id}}'">
                        <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                            <div
                                class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex {{ ($order->status == 0) ? 'bg-warning' : 'bg-success' }}">
                                {!! ($order->status == 0) ? '<small>Unpaid</small>' : 'Paid' !!}
                            </div>
                            <div class="job-content">
                                <h5 class="text-center text-md-left">Order Token: {{ $order->token }}</h5>
                                <span>Order Date: {{ $order->order_date }}</span><br>
                                <span><strong>Total :Rp {{ number_format($order->total,2, ',', '.') }}</strong></span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endsection