@extends('layouts.app')
@section('title', 'Checkout - Review')
@section('content')
@php
    $ship = $shipping ?? [];
    $pay = $payment ?? [];
    $card = $pay['card_number'] ?? '';
    $cardMask = $card !== '' ? '···· ' . substr($card, -4) : '';
@endphp
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
                    @foreach ($cartRows as $row)
                        @php $p = $row->product; @endphp
                        <div class="d-flex justify-content-between small mb-2">
                            <span>{{ $p->name }} ×{{ $row->quantity }}</span>
                            <span class="fw-bold">{{ number_format($row->line_total, 2, ',', ' ') }} €</span>
                        </div>
                    @endforeach
                </div>
                @if (! empty($ship))
                    <div class="border p-4 mb-4">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Shipping</h2>
                        <p class="small mb-1">{{ ($ship['first_name'] ?? '') }} {{ ($ship['last_name'] ?? '') }}</p>
                        <p class="small mb-1 text-secondary">{{ $ship['email'] ?? '' }}</p>
                        <p class="small mb-0">{{ $ship['address'] ?? '' }}, {{ $ship['city'] ?? '' }}, {{ $ship['state'] ?? '' }} {{ $ship['zip'] ?? '' }}</p>
                    </div>
                @endif
                @if (! empty($pay))
                    <div class="border p-4 mb-4">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Payment</h2>
                        <p class="small mb-1">{{ $pay['cardholder'] ?? '' }}</p>
                        <p class="small mb-1 text-secondary">{{ $cardMask }}</p>
                        <p class="small mb-0">Expires {{ $pay['expiry'] ?? '' }}</p>
                    </div>
                @endif
                <div class="border p-4 mb-4">
                    <p class="small mb-0"><a href="#" class="text-decoration-none text-body">Terms and conditions</a> apply.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('/src/order/payment.php') }}" class="btn btn-outline-dark rounded-0">Back</a>
                    <form method="post" action="{{ route('checkout.complete') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-dark rounded-0">Place order</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border p-4">
                    @include('partials.checkout-order-summary')
                </div>
            </div>
        </div>
    </main>
@endsection
