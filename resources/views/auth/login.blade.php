@extends('layouts.appAuth')

@section('title', 'Pizzy | Sign In')

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">

                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Log In</h3>
                            </div>
                        </div>
                        <div class="">
                            @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error')}}
                            </div>
                            @elseif(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success')}}
                            </div>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="signin-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Nama" name="email" id="email" required value="{{ old('name') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>
                        </form>
                        <p class="text-center">Not a member? <a href="{{ route('register') }}">Sign Up</a></p>
                    </div>
                    <div class="img" style="background-image: url(images/pizza.jpeg);">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
