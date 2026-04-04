@extends('layouts.app')
@section('title', 'Checkout - Payment')
@section('content')
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
                <form action="{{ url('/src/order/review.php') }}" method="get">
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label small fw-bold text-uppercase">Card number *</label>
                        <input type="text" class="form-control rounded-0" id="cardNumber" placeholder="0000 0000 0000 0000" required>
                    </div>
                    <div class="mb-3">
                        <label for="cardholder" class="form-label small fw-bold text-uppercase">Cardholder name *</label>
                        <input type="text" class="form-control rounded-0" id="cardholder" required>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="expiry" class="form-label small fw-bold text-uppercase">Expiry date *</label>
                            <input type="text" class="form-control rounded-0" id="expiry" placeholder="MM/YY" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cvv" class="form-label small fw-bold text-uppercase">CVV *</label>
                            <input type="text" class="form-control rounded-0" id="cvv" required>
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
@endsection
