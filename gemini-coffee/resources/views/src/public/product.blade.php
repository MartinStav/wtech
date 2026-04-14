@extends('layouts.app')
@section('title', $product->name.' - Premium coffee beans')
@section('content')
@php
    $images = $product->images;
    $main = $images->first()?->path ?? 'assets/logo.png';
@endphp
<main class="container py-5">
        <a href="{{ route('shop', request()->except('page')) }}" class="text-decoration-none text-dark d-inline-flex align-items-center gap-1 mb-4">
            <span>←</span> Back to Shop
        </a>

        @if ($errors->any())
            <div class="alert alert-danger rounded-0 small mb-4">{{ $errors->first() }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="ratio ratio-1x1 mb-2">
                    <img src="{{ asset($main) }}" alt="{{ $product->name }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" id="product-main-img">
                </div>
                @if ($images->count() > 1)
                <div class="d-flex gap-2">
                    @foreach ($images as $image)
                        <button type="button" class="ratio ratio-1x1 flex-grow-1 border-0 p-0 bg-transparent product-thumb" data-src="{{ asset($image->path) }}" aria-label="Show image {{ $loop->iteration }}">
                            <img src="{{ asset($image->path) }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                        </button>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col-lg-6">
                <span class="badge bg-dark rounded-0 mb-2">{{ $product->category->name }}</span>
                <h1 class="h2 fw-bold mb-2">{{ $product->name }}</h1>
                <p class="h3 fw-bold mb-4">{{ number_format((float) $product->price, 2, ',', ' ') }} €</p>

                <hr class="my-4">
                <div class="small fw-bold text-uppercase mb-2">Specs</div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-secondary">Origin:</span>
                    <span>{{ $product->origin_label ?? '—' }}</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-secondary">Roast:</span>
                    <span>{{ ucfirst($product->roast_level) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-secondary">Weight:</span>
                    <span>{{ $product->weight_grams }}g</span>
                </div>

                <hr class="my-4">
                <div class="small fw-bold text-uppercase mb-2">Description</div>
                <p class="mb-4">{{ $product->description }}</p>

                <form method="post" action="{{ route('cart.add') }}" class="mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="small fw-bold text-uppercase mb-2">Quantity</div>
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <button type="button" class="btn btn-outline-dark rounded-0" id="qty-minus">−</button>
                        <input type="number" name="quantity" id="product-qty" class="form-control rounded-0 text-center" value="1" min="1" max="{{ min(999, $product->stock_quantity) }}" style="max-width: 80px;">
                        <button type="button" class="btn btn-outline-dark rounded-0" id="qty-plus">+</button>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark rounded-0">Add to Cart</button>
                        <button type="submit" name="checkout" value="1" class="btn btn-outline-dark rounded-0">Buy Now</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@push('scripts')
<script>
(() => {
  const input = document.getElementById('product-qty');
  const max = input ? parseInt(input.getAttribute('max'), 10) || 999 : 999;
  document.getElementById('qty-minus')?.addEventListener('click', () => {
    if (!input) return;
    input.value = String(Math.max(1, (parseInt(input.value, 10) || 1) - 1));
  });
  document.getElementById('qty-plus')?.addEventListener('click', () => {
    if (!input) return;
    input.value = String(Math.min(max, (parseInt(input.value, 10) || 1) + 1));
  });
  document.querySelectorAll('.product-thumb').forEach((btn) => {
    btn.addEventListener('click', () => {
      const src = btn.getAttribute('data-src');
      const main = document.getElementById('product-main-img');
      if (src && main) main.setAttribute('src', src);
    });
  });
})();
</script>
@endpush
@endsection
