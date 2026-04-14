@extends('layouts.app')
@section('title', 'Checkout - Review')
@section('content')
<main class="container py-5">
        <h1 class="h2 fw-bold mb-4">Checkout</h1>

        <div class="row g-2 mb-4">
            <div class="col-4">
                <a href="{{ url('/src/order/shipping.php') }}" class="btn btn-outline-dark w-100 rounded-0 small text-uppercase">1 Shipping</a>
            </div>
            <div class="col-4">
                <a href="{{ url('/src/order/payment.php') }}" class="btn btn-outline-dark w-100 rounded-0 small text-uppercase">2 Payment</a>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-dark w-100 rounded-0 small text-uppercase" disabled>3 Review</button>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="border p-4 mb-4">
                    <h2 class="h6 fw-bold text-uppercase mb-3">Review order</h2>
                    <div class="d-flex justify-content-between">
                        <span>Colombian Supremo ×1</span>
                        <span class="fw-bold">15,99 €</span>
                    </div>
                </div>
                <div class="border p-4 mb-4">
                    <p class="small mb-0"><a href="#" class="text-decoration-none text-body">Terms and conditions</a> apply.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('/src/order/payment.php') }}" class="btn btn-outline-dark rounded-0">Back</a>
                    <button type="button" class="btn btn-dark rounded-0" data-bs-toggle="modal" data-bs-target="#paymentSuccessModal">Place order</button>
                </div>
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

        <div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0 border">
                    <div class="modal-header border-0 pb-0">
                        <h2 class="modal-title h5 fw-bold mb-0" id="paymentSuccessModalLabel">Payment successful</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <p class="mb-0">Your payment was received and your order is confirmed. Thank you for your purchase.</p>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <a href="{{ url('/home.php') }}" class="btn btn-dark rounded-0">Continue to home</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
