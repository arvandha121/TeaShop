@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Add Employee')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('employee.index') }}">Employee / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Add Employee</a>
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
                        <form method="post" action="{{ route('employee.store') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            {{--  <div class="form-group">
                                <label for="user">Email -> Role ID</label>
                                <select name="user" class="form-control">
                                    @foreach ($user as $us)
                                    <option value="{{ $us->id }}">{{ $us->email }} -> {{ $us->role_id }}</option>
                                    @endforeach
                                </select>
                            </div>  --}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" class="form-control">
                                    <option value="2">Kasir</option>
                                    <option value="3">Staff Dapur</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" aria-describedby="date_of_birth">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    aria-describedby="address">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    aria-describedby="phone">
                            </div>
                            <div class="form-group">
                                <label for="sex">Gender</label>
                                <select name="sex" class="form-control">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
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