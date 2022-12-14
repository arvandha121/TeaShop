@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Edit Password')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark"
                            href="{{ route('employee.kasir.show_profile', auth()->user()->employee->id) }}">Employee Profile / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Edit Password</a>
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
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <form method="post" action="{{ route('employee.kasir.update_password', auth()->user()->employee->id) }}"
                            id="myForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" id="name" value="{{ auth()->user()->name }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="role_id" id="role_id" value="{{ auth()->user()->role_id }}">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    aria-describedby="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                    aria-describedby="confirm_password">
                            </div>
                            <button class="btn text-white" style="background-color: #b68834;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection