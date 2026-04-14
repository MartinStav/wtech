@extends('layouts.app')
@section('title', 'Shopping cart - Premium coffee beans')
@section('content')
<main class="container py-5">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <h1 class="h2 fw-bold mb-0">Shopping cart</h1>
            <form method="post" action="{{ route('cart.clear') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-dark btn-sm rounded-0">Clear cart</button>
            </form>
        </div>

        @if (session('status'))
            <div class="alert alert-success rounded-0 small mb-4">{{ session('status') }}</div>
        @endif
        @if (session('checkout_error'))
            <div class="alert alert-warning rounded-0 small mb-4">{{ session('checkout_error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger rounded-0 small mb-4">{{ $errors->first() }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                @foreach ($cartRows as $row)
                    @php
                        /** @var \App\Models\Product $p */
                        $p = $row->product;
                        $thumb = $p->images->first()?->path ?? 'assets/logo.png';
                        $subtitle = collect([$p->origin_label, ucfirst($p->roast_level), $p->weight_grams.'g'])->filter()->implode(' | ');
                    @endphp
                    <div class="border p-3 position-relative mb-3">
                        <form method="post" action="{{ route('cart.remove') }}" class="position-absolute top-0 end-0 mt-2 me-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                            <button type="submit" class="btn btn-link btn-sm text-secondary text-decoration-none">Remove</button>
                        </form>
                        <div class="row g-3">
                            <div class="col-4 col-md-3">
                                <a href="{{ route('product.show', ['id' => $p->id]) }}" class="d-block text-decoration-none">
                                    <div class="ratio ratio-1x1"><img src="{{ asset($thumb) }}" alt="{{ $p->name }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                                </a>
                            </div>
                            <div class="col-8 col-md-9">
                                <h2 class="h5 fw-bold mb-1"><a href="{{ route('product.show', ['id' => $p->id]) }}" class="text-dark text-decoration-none">{{ $p->name }}</a></h2>
                                <p class="small text-secondary mb-3">{{ $subtitle }}</p>
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <form method="post" action="{{ route('cart.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                                        <input type="hidden" name="quantity" value="{{ max(1, $row->quantity - 1) }}">
                                        <button type="submit" class="btn btn-outline-dark btn-sm rounded-0">−</button>
                                    </form>
                                    <form method="post" action="{{ route('cart.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                                        <input type="number" name="quantity" class="form-control form-control-sm rounded-0 text-center" value="{{ $row->quantity }}" min="1" max="{{ min(999, $p->stock_quantity) }}" style="width: 4rem;" onchange="this.form.submit()">
                                    </form>
                                    <form method="post" action="{{ route('cart.update') }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                                        <input type="hidden" name="quantity" value="{{ min((int) $p->stock_quantity, $row->quantity + 1) }}">
                                        <button type="submit" class="btn btn-outline-dark btn-sm rounded-0">+</button>
                                    </form>
                                </div>
                                <div class="mt-3 text-end">
                                    <p class="small text-secondary mb-0">{{ number_format((float) $p->price, 2, ',', ' ') }} € each</p>
                                    <p class="h5 fw-bold mb-0">{{ number_format($row->line_total, 2, ',', ' ') }} €</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4">
                <div class="border p-4">
                    <h2 class="h6 fw-bold text-uppercase mb-3">Order summary</h2>
                    <div class="d-flex justify-content-between mb-2 small">
                        <span>Subtotal</span>
                        <span>{{ number_format($subtotal, 2, ',', ' ') }} €</span>
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
                        <span>{{ number_format($subtotal, 2, ',', ' ') }} €</span>
                    </div>
                    <a href="{{ url('/src/order/shipping.php') }}" class="btn btn-dark w-100 rounded-0 mb-2">Proceed to checkout</a>
                    <a href="{{ route('shop') }}" class="btn btn-outline-dark w-100 rounded-0">Continue shopping</a>
                </div>
            </div>
        </div>
    </main>
@endsection
