@extends('layouts.masterLayout')

@section('title', 'Coffeeup | Edit Password')

@section('container')

<div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
<section class="user-area pt-4 pb-5" id="coffee">
    <div class="container mt-5 bg-white rounded">
        <div class="main-panel">
            <div class="content-wrapper ml-5">
                <div class="row ml-5">
                    <div class="col-lg-8 grid-margin stretch-card" style="margin-left: 15%">
                        <div class="card">
                            <div class="card-header">
                                <a style="text-decoration: none;" class="text-dark font-xl"
                                    href="{{ route('user.profile') }}">User / </a>
                                <a style="text-decoration: none;" class="text-dark font-weight-bold font-xl" href="#">Change Password</a>
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
                                <form method="post" action="{{ route('user.update', $user->id) }}" id="myForm">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name" id="name" value="{{ $user->name }}">
                                    <input type="hidden" name="email" id="email" value="{{ $user->email }}">
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" id="password1"
                                            aria-describedby="password1">
                                    </div>
                                    <button class="btn text-white" style="background-color: #b68834;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection