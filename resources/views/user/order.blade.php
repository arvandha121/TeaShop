@section('title', 'Coffeeup | Order Receipt')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/orderStyle.css') }}">
<link rel="shortcut icon" href="{{ asset('images/fav.png') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<title>@yield('title')</title>

<div class="container mb-5 mt-5">
    <div class="h3">
        <a href="{{ route('order.all', auth()->user()->id) }}">
            <i class="fa fa-arrow-left text-sm pr-2 text-white font-weight-bold"></i>
        </a>
    </div>
    <div class="col-md-6 m-auto" id="staticBackdrop">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="px-4 py-5">
                        <h5 class="text-uppercase">{{ $orders->user->name }}</h5>
                        <h4 class="mt-5 theme-color">Thanks for your order</h4>
                        <h4 class="theme-color mb-5">{{ $orders->order_date }}</h4>

                        <span class="theme-color">Payment Summary</span>
                        <div class="mb-3">
                            <hr class="new1">
                        </div>

                        @foreach ($orders->orderDetail as $od)
                        <div class="d-flex justify-content-between">
                            @php
                            $name = explode(" ",$od->menu->name);
                            $names = '';
                            if(count($name) > 2):
                            $names = $name[0] . " " . $name[1] . " " . $name[2];
                            elseif(count($name) < 2): $names=$name[0]; else: $names=$name[0] . " " . $name[1]; endif;
                                @endphp <span class="font-weight-bold">{{$names}}(Qty:{{ $od->qty }})</span>
                                <span class="text-muted">Rp {{ number_format($od->menu->price * $od->qty, 2, ',', '.')
                                    }}</span>
                        </div>
                        @endforeach

                        <div class="d-flex justify-content-between mt-3">
                            <span class="font-weight-bold">Total</span>
                            <span class="font-weight-bold theme-color">Rp {{ number_format($orders->total, 2, ',', '.')
                                }}</span>
                        </div>
                        <div class="text-center mt-5">
                            @if($orders->status == 0)
                            <p class="mt-5 text-center fw-bolder">Goto cashier and scan it to finish order</p>
                            {{ $qrcode }}
                            @else
                            <p class="text-center fw-bolder">Order complete! Have a nice day</p>
                            <div class="d-flex justify-content-center">
                                <i class="fa-solid fa-circle-check "
                                    style="color: rgb(102, 231, 102); font-size: 10rem;"></i>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>