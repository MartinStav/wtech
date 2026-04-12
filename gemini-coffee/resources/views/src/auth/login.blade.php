@extends('layouts.app')
@section('title', 'Login')
@section('content')
<main class="auth-main">
        <section class="container py-4 py-md-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                    <div class="text-center mb-5">
                        <h1 class="mb-2">Login</h1>
                        <p class="text-secondary mb-0">Enter your credentials to access your account</p>
                    </div>
                    <form class="login-form" method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label form-label-sm fw-bold text-uppercase">Email</label>
                            <input required type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ 'your@email.com' }}" autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label form-label-sm fw-bold text-uppercase">Password</label>
                            <input required type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="••••••••" autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" value="1" class="form-check-input" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mb-3 small fw-bold text-uppercase py-2">Login</button>
                        <p class="text-center mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-underline text-dark">Register</a></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
