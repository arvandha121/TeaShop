@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Edit Menu')

@section('container')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <a style="text-decoration: none;" class="text-dark" href="{{ route('menu.index') }}">Menu / </a>
                            <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Edit Menu</a>
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
                            <form method="post" action="{{ route('menu.update', $menu->id) }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ $menu->name }}" aria-describedby="name">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control">
                                        @if ($menu->type === 'food')
                                            <option selected value="food">Food</option>
                                            <option value="beverage">Beverage</option>
                                        @else
                                            <option selected value="beverage">Beverage</option>
                                            <option value="food">Food</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price"
                                        value="{{ $menu->price }}" aria-describedby="price">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" class="form-control" id="stock"
                                        value="{{ $menu->stock }}" aria-describedby="price">
                                </div>
                                <div class="form-group">
                                    <label for="image">Picture</label>
                                    <input type="file" class="form-control" name="image"
                                        value="{{ $menu->meu_photo_path }}"></br>
                                    @if ($menu->menu_photo_path != null)
                                        @php
                                            $img = $menu->menu_photo_path;
                                        @endphp
                                    @else
                                        @php
                                            $img = 'images/default_menu.png';
                                        @endphp
                                    @endif
                                    <img width="150px" src="{{ 'https://storage.googleapis.com/taufik-bucket/' . $img }}">
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
