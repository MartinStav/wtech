@extends('layouts.app')
@section('title', 'Checkout - Shipping')
@section('content')
@php
    $s = $shipping ?? [];
    $val = fn (string $key, string $default = '') => old($key, $s[$key] ?? $default);
@endphp
<main class="container py-5">
        <h1 class="h2 fw-bold mb-4">Checkout</h1>

        @if (session('checkout_error'))
            <div class="alert alert-warning rounded-0 mb-4" role="alert">{{ session('checkout_error') }}</div>
        @endif

        <div class="row g-2 mb-4">
            <div class="col-4">
                <button type="button" class="btn btn-dark w-100 rounded-0 small text-uppercase" disabled>1 Shipping</button>
            </div>
            <div class="col-4">
                <a href="{{ url('/src/order/payment.php') }}" class="btn btn-outline-dark w-100 rounded-0 small text-uppercase">2 Payment</a>
            </div>
            <div class="col-4">
                <a href="{{ url('/src/order/review.php') }}" class="btn btn-outline-dark w-100 rounded-0 small text-uppercase">3 Review</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <form action="{{ url('/src/order/shipping.php') }}" method="post" novalidate>
                    @csrf
                    <h2 class="h6 fw-bold text-uppercase mb-3">Shipping method</h2>
                    <div class="list-group list-group-flush border mb-4 rounded-0">
                        <label class="list-group-item d-flex gap-3 align-items-start">
                            <input class="form-check-input mt-1" type="radio" name="shipping_method" value="standard" {{ $val('shipping_method', 'standard') === 'standard' ? 'checked' : '' }}>
                            <span><strong>Standard shipping</strong> — 5–7 business days <span class="text-secondary">5,00 €</span></span>
                        </label>
                        <label class="list-group-item d-flex gap-3 align-items-start">
                            <input class="form-check-input mt-1" type="radio" name="shipping_method" value="express" {{ $val('shipping_method') === 'express' ? 'checked' : '' }}>
                            <span><strong>Express shipping</strong> — 2–3 business days <span class="text-secondary">15,00 €</span></span>
                        </label>
                        <label class="list-group-item d-flex gap-3 align-items-start">
                            <input class="form-check-input mt-1" type="radio" name="shipping_method" value="overnight" {{ $val('shipping_method') === 'overnight' ? 'checked' : '' }}>
                            <span><strong>Overnight</strong> — next day delivery <span class="text-secondary">25,00 €</span></span>
                        </label>
                    </div>
                    @error('shipping_method')
                        <div class="text-danger small mb-3">{{ $message }}</div>
                    @enderror
                    <h2 class="h6 fw-bold text-uppercase mb-3">Shipping information</h2>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label small fw-bold text-uppercase">First name</label>
                            <input type="text" class="form-control rounded-0 @error('first_name') is-invalid @enderror" id="firstName" name="first_name" value="{{ $val('first_name') }}" required maxlength="100">
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label small fw-bold text-uppercase">Last name</label>
                            <input type="text" class="form-control rounded-0 @error('last_name') is-invalid @enderror" id="lastName" name="last_name" value="{{ $val('last_name') }}" required maxlength="100">
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold text-uppercase">Email</label>
                        <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ $val('email') }}" required maxlength="255" autocomplete="email" pattern="^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$" title="Use an address with a domain extension, e.g. name@example.com">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small fw-bold text-uppercase">Address</label>
                        <input type="text" class="form-control rounded-0 @error('address') is-invalid @enderror" id="address" name="address" value="{{ $val('address') }}" required maxlength="255">
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label for="city" class="form-label small fw-bold text-uppercase">City</label>
                            <input type="text" class="form-control rounded-0 @error('city') is-invalid @enderror" id="city" name="city" value="{{ $val('city') }}" required maxlength="100">
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label small fw-bold text-uppercase">State</label>
                            <input type="text" class="form-control rounded-0 @error('state') is-invalid @enderror" id="state" name="state" value="{{ $val('state') }}" required maxlength="100">
                            @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label for="zip" class="form-label small fw-bold text-uppercase">Zip</label>
                            <input type="text" class="form-control rounded-0 @error('zip') is-invalid @enderror" id="zip" name="zip" value="{{ $val('zip') }}" required inputmode="numeric" pattern="[0-9]{4,10}" maxlength="10" title="Digits only, 4–10 characters">
                            @error('zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 rounded-0 py-2">Continue</button>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="border p-4">
                    <h2 class="h6 fw-bold text-uppercase mb-3">Order summary</h2>
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Colombian Supremo ×1</span>
                        <span>15,99 €</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span>Subtotal</span>
                        <span>15,99 €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span>Shipping</span>
                        <span>5,00 €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 small">
                        <span>Tax</span>
                        <span>1,36 €</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>22,35 €</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@push('scripts')
<script>
(function () {
    var zip = document.getElementById('zip');
    if (!zip) return;
    function clean() {
        zip.value = zip.value.replace(/\D/g, '').slice(0, 10);
    }
    zip.addEventListener('input', clean);
    zip.addEventListener('paste', function (e) {
        e.preventDefault();
        var t = (e.clipboardData || window.clipboardData).getData('text') || '';
        zip.value = t.replace(/\D/g, '').slice(0, 10);
    });
})();
</script>
@endpush
@endsection
