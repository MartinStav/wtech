@extends('layouts.app')
@section('title', 'Shopping cart - Premium coffee beans')
@section('content')
<main class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <h1 class="h2 fw-bold mb-0">Shopping cart</h1>
            <a href="{{ url('/src/order/basket-empty.php') }}" class="btn btn-outline-dark btn-sm rounded-0">Clear cart</a>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="border p-3 position-relative">
                    <button type="button" class="btn btn-link btn-sm text-secondary position-absolute top-0 end-0 mt-2 me-2 text-decoration-none">Remove</button>
                    <div class="row g-3">
                        <div class="col-4 col-md-3">
                            <div class="ratio ratio-1x1"><img src="{{ asset('assets/brazilian.png') }}" alt="Brazilian Santos" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        </div>
                        <div class="col-8 col-md-9">
                            <h2 class="h5 fw-bold mb-1">Colombian Supremo</h2>
                            <p class="small text-secondary mb-3">Colombia | Medium | 250g</p>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <button type="button" class="btn btn-outline-dark btn-sm rounded-0">−</button>
                                <input type="number" class="form-control form-control-sm rounded-0 text-center" value="1" min="1" style="width: 4rem;">
                                <button type="button" class="btn btn-outline-dark btn-sm rounded-0">+</button>
                            </div>
                            <div class="mt-3 text-end">
                                <p class="small text-secondary mb-0">15,99 € each</p>
                                <p class="h5 fw-bold mb-0">15,99 €</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border p-4">
                    <h2 class="h6 fw-bold text-uppercase mb-3">Order summary</h2>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span>Subtotal</span>
                        <span>15,99 €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span>Shipping</span>
                        <span class="text-secondary">TBD</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 small">
                        <span>Tax</span>
                        <span class="text-secondary">TBD</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4 fw-bold">
                        <span>Total</span>
                        <span>15,99 €</span>
                    </div>
                    <a href="{{ url('/src/order/shipping.php') }}" class="btn btn-dark w-100 rounded-0 mb-2">Proceed to checkout</a>
                    <a href="{{ url('/src/public/shop.php') }}" class="btn btn-outline-dark w-100 rounded-0">Continue shopping</a>
                </div>
            </div>
        </div>
    </main>
@endsection
