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
                    <form class="login-form">
                        <div class="mb-3">
                            <label for="loginUser" class="form-label form-label-sm fw-bold text-uppercase">Email / Username</label>
                            <input required type="text" class="form-control" id="loginUser" placeholder="your@@email.com" autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label form-label-sm fw-bold text-uppercase">Password</label>
                            <input required type="password" class="form-control" id="password" placeholder="••••••••">
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mb-3 small fw-bold text-uppercase py-2">Login</button>
                        <p class="text-center mb-0">Don't have an account? <a href="{{ url('/src/auth/register.php') }}" class="text-decoration-underline text-dark">Register</a></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
<script>
        document.querySelector('.login-form').addEventListener('submit', function (e) {
            e.preventDefault();
            var u = document.getElementById('loginUser').value.trim();
            var p = document.getElementById('password').value;
            if (u === 'admin' && p === 'admin') {
                window.location.href = @json(url('/src/admin/dashboard.php'));
            } else {
                window.location.href = @json(url('/src/public/shop.php'));
            }
        });
    </script>
@endpush
