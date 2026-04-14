@extends('layouts.app')
@section('title', 'Checkout - Payment')
@section('content')
@php
    $p = $payment ?? [];
    $val = fn (string $key, string $default = '') => old($key, $p[$key] ?? $default);
@endphp
<main class="container py-5">
        <h1 class="h2 fw-bold mb-4">Checkout</h1>

        <div class="row g-2 mb-4">
            <div class="col-4">
                <a href="{{ url('/src/order/shipping.php') }}" class="btn btn-outline-dark w-100 rounded-0 small text-uppercase">1 Shipping</a>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-dark w-100 rounded-0 small text-uppercase" disabled>2 Payment</button>
            </div>
            <div class="col-4">
                <a href="{{ url('/src/order/review.php') }}" class="btn btn-outline-dark w-100 rounded-0 small text-uppercase">3 Review</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <h2 class="h6 fw-bold text-uppercase mb-3">Payment information</h2>
                <form action="{{ url('/src/order/payment.php') }}" method="post" id="payment-form" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label small fw-bold text-uppercase">Card number *</label>
                        <input type="text" class="form-control rounded-0 @error('card_number') is-invalid @enderror" id="cardNumber" name="card_number" value="{{ $val('card_number') }}" placeholder="0000000000000000" required inputmode="numeric" autocomplete="cc-number" maxlength="19" data-digits-only data-max-digits="19" title="Digits only, 13–19 digits">
                        @error('card_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="cardholder" class="form-label small fw-bold text-uppercase">Cardholder name *</label>
                        <input type="text" class="form-control rounded-0 @error('cardholder') is-invalid @enderror" id="cardholder" name="cardholder" value="{{ $val('cardholder') }}" required maxlength="120" autocomplete="cc-name">
                        @error('cardholder')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="expiry" class="form-label small fw-bold text-uppercase">Expiry date *</label>
                            <input type="text" class="form-control rounded-0 @error('expiry') is-invalid @enderror" id="expiry" name="expiry" value="{{ $val('expiry') }}" placeholder="MM/YY" required inputmode="numeric" autocomplete="cc-exp" maxlength="5" data-expiry-mask title="MM/YY">
                            @error('expiry')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="cvv" class="form-label small fw-bold text-uppercase">CVV *</label>
                            <input type="text" class="form-control rounded-0 @error('cvv') is-invalid @enderror" id="cvv" name="cvv" value="{{ $val('cvv') }}" required inputmode="numeric" autocomplete="cc-csc" maxlength="3" pattern="[0-9]{3}" data-digits-only data-max-digits="3" title="Exactly 3 digits">
                            @error('cvv')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url('/src/order/shipping.php') }}" class="btn btn-outline-dark rounded-0">Back</a>
                        <button type="submit" class="btn btn-dark rounded-0">Continue</button>
                    </div>
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
    function digitsOnly(el, maxDigits) {
        el.addEventListener('input', function () {
            var d = el.value.replace(/\D/g, '');
            if (maxDigits) d = d.slice(0, maxDigits);
            el.value = d;
        });
        el.addEventListener('paste', function (e) {
            e.preventDefault();
            var t = (e.clipboardData || window.clipboardData).getData('text') || '';
            var d = t.replace(/\D/g, '');
            if (maxDigits) d = d.slice(0, maxDigits);
            el.value = d;
        });
    }
    var card = document.getElementById('cardNumber');
    var cvv = document.getElementById('cvv');
    var exp = document.getElementById('expiry');
    if (card) digitsOnly(card, parseInt(card.getAttribute('data-max-digits') || '19', 10));
    if (cvv) digitsOnly(cvv, parseInt(cvv.getAttribute('data-max-digits') || '3', 10));
    if (exp) {
        exp.addEventListener('input', function () {
            var raw = exp.value.replace(/\D/g, '').slice(0, 4);
            if (raw.length <= 2) exp.value = raw;
            else exp.value = raw.slice(0, 2) + '/' + raw.slice(2);
        });
        exp.addEventListener('paste', function (e) {
            e.preventDefault();
            var t = (e.clipboardData || window.clipboardData).getData('text') || '';
            var raw = t.replace(/\D/g, '').slice(0, 4);
            if (raw.length <= 2) exp.value = raw;
            else exp.value = raw.slice(0, 2) + '/' + raw.slice(2);
        });
    }
})();
</script>
@endpush
@endsection
