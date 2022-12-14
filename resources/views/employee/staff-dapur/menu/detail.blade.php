@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Detail Menu')

@section('container')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <a style="text-decoration: none;" class="text-dark" href="{{ route('menu.index') }}">Menu / </a>
                            <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Detail
                                Menu</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>Menu Id</th>
                                    <td>{{ $menu->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $menu->name }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ $menu->type }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $menu->price }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $menu->stock }}</td>
                                </tr>
                                <tr>
                                    <th>Picture</th>
                                    @if ($menu->menu_photo_path != null)
                                        @php
                                            $img = $menu->menu_photo_path;
                                        @endphp
                                    @else
                                        @php
                                            $img = 'images/default_menu.png';
                                        @endphp
                                    @endif
                                    <td><img width="100px" class="rounded"
                                            src="{{ 'https://storage.googleapis.com/taufik-bucket/' . $img }}"></td>
                                </tr>
                            </table>
                            <a class="btn btn-success mt-3" href="{{ route('menu.index') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
