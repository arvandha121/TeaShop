@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Add Menu')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('menu.index') }}">Menu / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Add Menu</a>
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
                        <form method="post" action="{{ route('menu.store') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" class="form-control">
                                    <option value="food">Food</option>
                                    <option value="beverage">Beverage</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" id="price"
                                    aria-describedby="price">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" class="form-control" id="stock"
                                    aria-describedby="stock">
                            </div>
                            <div class="form-group">
                                <label for="image">Picture</label>
                                <input type="file" class="form-control" name="image"></br>
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