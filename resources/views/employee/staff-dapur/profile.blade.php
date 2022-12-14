@extends('layouts.dashboardLayout')

@section('title', 'Coffeeup | Employee Profile')

@section('container')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Employee Profile </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-error">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <div class="d-flex">
                            <div class="col-8">
                                <table class=" table table-striped table-hover">
                                    <tr>
                                        <th class="col-3">Employee ID</th>
                                        <td class="col-3">{{ $employee->id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Role</th>
                                        @if (auth()->user()->role_id == 2)
                                        <td class="col-3">Kasir</td>
                                        @else
                                        <td class="col-3">Staff Dapur</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th class="col-3">Name</th>
                                        <td class="col-3">{{ auth()->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Email</th>
                                        <td class="col-3">{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Date of Birth</th>
                                        <td class="col-3">{{ $employee->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Address</th>
                                        <td class="col-3">{{ $employee->address }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Phone</th>
                                        <td class="col-3">{{ $employee->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-3">Gender</th>
                                        <td class="col-3">
                                            @if ($employee->sex === 'F')
                                            {{ 'Female' }}
                                            @else
                                            {{ 'Male' }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @if (auth()->user()->profile_path != NULL)
                            @php
                            $img = auth()->user()->profile_path
                            @endphp
                            @else
                            @php
                            $img = 'user_profiles/employee.png'
                            @endphp
                            @endif
                            <div class="col-6 justify-content-center" >
                                <div class="mx-4">
                                    <img style="max-width: 200px; max-height: 200px;" class="ml-5 pl-5 mx-3 rounded"
                                    src="{{ asset('storage/'.$img) }}" alt="">
                                </div>
                                    <div class="mt-5 mb-3 mx-5">
                                        <a href="{{ route('employee.staff.edit_profile', $employee->id) }}">
                                            <button class="btn text-white" style="width:200px; background-color: #b68834;">
                                                Edit profile
                                            </button>
                                        </a>
                                    </div>
                                    <div class="mt-3 mb-3 mx-5">
                                        <a href="{{ route('employee.staff.edit_password', auth()->user()->id) }}">
                                            <button class="btn text-white" style="width:200px; background-color: rgb(20, 2, 0)">
                                                Change password
                                            </button>
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            </section>

            @endsection