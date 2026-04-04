@extends('layouts.app')
@section('title', 'Checkout - Shipping')
@section('content')
<main class="container py-5">
        <h1 class="h2 fw-bold mb-4">Checkout</h1>

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
                <h2 class="h6 fw-bold text-uppercase mb-3">Shipping method</h2>
                <div class="list-group list-group-flush border mb-4 rounded-0">
                    <label class="list-group-item d-flex gap-3 align-items-start">
                        <input class="form-check-input mt-1" type="radio" name="shipping" checked>
                        <span><strong>Standard shipping</strong> — 5–7 business days <span class="text-secondary">5,00 €</span></span>
                    </label>
                    <label class="list-group-item d-flex gap-3 align-items-start">
                        <input class="form-check-input mt-1" type="radio" name="shipping">
                        <span><strong>Express shipping</strong> — 2–3 business days <span class="text-secondary">15,00 €</span></span>
                    </label>
                    <label class="list-group-item d-flex gap-3 align-items-start">
                        <input class="form-check-input mt-1" type="radio" name="shipping">
                        <span><strong>Overnight</strong> — next day delivery <span class="text-secondary">25,00 €</span></span>
                    </label>
                </div>

                <h2 class="h6 fw-bold text-uppercase mb-3">Shipping information</h2>
                <form action="{{ url('/src/order/payment.php') }}" method="get">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label small fw-bold text-uppercase">First name</label>
                            <input type="text" class="form-control rounded-0" id="firstName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label small fw-bold text-uppercase">Last name</label>
                            <input type="text" class="form-control rounded-0" id="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-bold text-uppercase">Email</label>
                        <input type="email" class="form-control rounded-0" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label small fw-bold text-uppercase">Address</label>
                        <input type="text" class="form-control rounded-0" id="address" required>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label for="city" class="form-label small fw-bold text-uppercase">City</label>
                            <input type="text" class="form-control rounded-0" id="city" required>
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label small fw-bold text-uppercase">State</label>
                            <input type="text" class="form-control rounded-0" id="state" required>
                        </div>
                        <div class="col-md-3">
                            <label for="zip" class="form-label small fw-bold text-uppercase">Zip</label>
                            <input type="text" class="form-control rounded-0" id="zip" required>
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
@endsection
