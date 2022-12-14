@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Edit Profile')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark"
                            href="{{ route('employee.staff.show_profile', auth()->user()->employee->id) }}">Employee
                            Profile / </a>
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
                        <form method="post" action="{{ route('employee.staff.update_profile', $employee->id) }}"
                            id="myForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" id="user_id" value="{{ $employee->user_id }}">
                            <input type="hidden" name="role_id" id="role_id" value="{{ $employee->user->role_id }}">
                            <input type="hidden" name="password" id="password" value="{{ $employee->user->password }}">
                            <div class="form-group">
                                <label for="image">Photo Profile</label><br>
                                @if (auth()->user()->profile_path != NULL)
                                @php
                                $img = auth()->user()->profile_path
                                @endphp
                                @else
                                @php
                                $img = 'user_profiles/employee.png'
                                @endphp
                                @endif
                                <img width="150px" class="mb-3" src="{{ asset('storage/'.$img) }}">
                                <input type="file" class="form-control" name="image"
                                    value="{{$employee->user->profile_path}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $employee->user->name }}" aria-describedby="name">
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth"
                                    value="{{ $employee->date_of_birth }}" aria-describedby="date_of_birth">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    value="{{ $employee->address }}" aria-describedby="address">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    value="{{ $employee->phone }}" aria-describedby="phone">
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