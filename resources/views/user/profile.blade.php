@extends('layouts.masterLayout')

@section('title', 'Pizzy | User Profile')

@section('container')

<div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
<section class="menu-area pt-4 pb-5" id="coffee">
    <div class="container mt-5 bg-white rounded">
        <div class="border-bottom pt-4 mb-5 pb-3">
            <h1 align="center">User Profile</h1>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="d-flex pb-3 pl-5">
            <div class="col-6 ml-5 pl-5 pr-5">
                <table class="table-hover table-striped pl-5">
                    <tr style="height: 70px">
                        <th class="col-3">User ID</th>
                        <td  class="col-3">{{ auth()->user()->id }}</td>
                    </tr>
                    <tr style="height: 70px">
                        <th class="col-3">Name</th>
                        <td class="col-3">{{ auth()->user()->name }}</td>
                    </tr>
                    <tr style="height: 70px">
                        <th class="col-3">Email</th>
                        <td class="col-3">{{ auth()->user()->email }}</td>
                    </tr>
                </table>
            </div>
            @if (auth()->user()->profile_path != NULL)
            @php
            $img = auth()->user()->profile_path
            @endphp
            @else
            @php
            $img = 'images/default_profile.png'
            @endphp
            @endif
            <div class="col-6  justify-content-center">
                <img style="max-width: 250px; max-height: 250px;" class="rounded" src="{{ 'https://storage.googleapis.com/laravel-cafe-app/' . $img }}" alt="">
            </div>
        </div>
        <div class="mx-5 pr-5 mb-5 pb-5" style="margin-right: 50px;" align="right">
            <a href="{{ route('user.edit', auth()->user()->id) }}">
                <button class="btn text-white ml-2" style="background-color: #b68834;">
                    Edit profile
                </button>
            </a>
            <a href="{{ route('user.edit_password', auth()->user()->id) }}">
                <button class="btn text-white" style="background-color: rgb(20, 2, 0)">
                    Change password
                </button>
            </a>
        </div>
    </div>
</section>

@endsection
