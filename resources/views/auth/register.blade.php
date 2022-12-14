@extends('layouts.appAuth')

@section('title', 'Coffeeup | Sign Up')

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">                    
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Sign Up</h3>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('register') }}" class="signin-form">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="label" for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" name="name" id="name" required value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email" required value="{{ old('email') }}">
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
                            <div class="form-group mb-3">
                                <label class="label" for="password-confirm">Password Confirmation</label>
                                <input type="password" class="form-control @error('password-confirm') is-invalid @enderror" placeholder="Confirm password" id="password-confirm" name="password_confirmation" required>
                                @error('password-confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign Up</button>
                            </div>
                        </form>
                        <p class="text-center">Have account? <a href="{{route('login')}}">Sign In</a></p>
                    </div>
                    <div class="img" style="background-image: url({{asset('images/bg-1.jpg')}});"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
