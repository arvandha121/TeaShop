@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Edit Employee')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('employee.index') }}">Employee / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Edit Employee</a>
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
                        <form method="post" action="{{ route('employee.update', $employee->id) }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="user_id">User ID</label>
                                <input type="text" name="user_id" class="form-control" id="user_id" disabled value="{{ $employee->user_id }}">
                                <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $employee->user_id }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $employee->user->name }}" aria-describedby="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ $employee->user->email }}" aria-describedby="email">
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" class="form-control">
                                    @if ($employee->user->role_id === 2)
                                    <option selected value="2">Kasir</option>
                                    <option value="3">Staff Dapur</option>
                                    @else
                                    <option value="2">Kasir</option>
                                    <option selected value="3">Staff Dapur</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="{{ $employee->date_of_birth }}"
                                    aria-describedby="date_of_birth">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $employee->address }}"
                                    aria-describedby="address">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ $employee->phone }}"
                                    aria-describedby="phone">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="sex" class="form-control">
                                    @if ($employee->sex === 'M')
                                    <option selected value="M">Male</option>
                                    <option value="F">Female</option>
                                    @else
                                    <option selected value="F">Female</option>
                                    <option value="M">Male</option>
                                    @endif
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