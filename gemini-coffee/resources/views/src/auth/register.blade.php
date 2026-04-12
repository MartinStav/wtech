@extends('layouts.app')
@section('title', 'Register')
@section('content')
<main class="auth-main">
        <section class="container py-4 py-md-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                    <div class="text-center mb-5">
                        <h1 class="mb-2">Register</h1>
                        <p class="text-secondary mb-0">Create a new account to get started</p>
                    </div>
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label small fw-bold text-uppercase">Full name</label>
                            <input required type="text" name="name" value="{{ old('name') }}" class="form-control rounded-0 @error('name') is-invalid @enderror" id="name" placeholder="John Doe">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-uppercase">Email</label>
                            <input required type="email" name="email" value="{{ old('email') }}" class="form-control rounded-0 @error('email') is-invalid @enderror" id="email" placeholder="{{ 'your@email.com' }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-uppercase">Password</label>
                            <input required type="password" name="password" class="form-control rounded-0 @error('password') is-invalid @enderror" id="password" placeholder="••••••••" autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-bold text-uppercase">Confirm password</label>
                            <input required type="password" name="password_confirmation" class="form-control rounded-0" id="password_confirmation" placeholder="••••••••" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mb-3 small fw-bold text-uppercase rounded-0">Register</button>
                        <p class="text-center mb-0">Already have an account? <a href="{{ route('login') }}" class="text-decoration-underline text-dark">Login</a></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
