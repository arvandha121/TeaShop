@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Detail Employee')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark"
                            href="{{ route('employee.index') }}">Employee / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Detail
                            Employee</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Employee ID</th>
                                <td>{{$employee->id}}</td>
                            </tr>
                            <tr>
                                <th>User ID</th>
                                <td>{{$employee->user_id}}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    @if ($employee->role_id === 2)
                                    {{ 'Kasir' }}
                                    @else
                                    {{ 'Staff Dapur' }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$employee->user->email}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$employee->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{$employee->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{$employee->address}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$employee->phone}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                @if ($employee->sex === 'F')
                                {{ 'Female' }}
                                @else
                                {{ 'Male' }}
                                @endif
                                </td>
                            </tr>
                        </table>
                        <a class="btn btn-success mt-3" href="{{ route('employee.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection