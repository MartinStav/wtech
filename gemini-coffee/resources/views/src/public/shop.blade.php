@extends('layouts.app')
@section('title', 'Shop - Premium coffee beans')
@section('content')
@php
    $qBase = request()->except(['q', 'page']);
    $shopQuery = fn (array $merge = []) => route('shop', array_merge(request()->except('page'), $merge));
@endphp
<main class="container py-5" data-shop-scroll-root data-shop-path="{{ parse_url(url('/src/public/shop.php'), PHP_URL_PATH) }}">
        <section class="mb-5">
            <h1 class="h2 fw-bold mb-2">All products</h1>
            <p class="text-secondary mb-0">Browse our complete coffee collection.</p>
        </section>

        <section class="mb-5">
            <h2 class="h6 fw-bold text-uppercase mb-3">Search</h2>
            <form method="get" action="{{ route('shop') }}" class="d-flex flex-wrap gap-2">
                @foreach ($qBase as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                <input type="search" name="q" value="{{ request('q') }}" class="form-control form-control-lg rounded-0 flex-grow-1" placeholder="Search by name, description, category, origin...">
                <button type="submit" class="btn btn-dark rounded-0">Search</button>
            </form>
        </section>

        <section class="mb-5">
            <h2 class="h6 fw-bold text-uppercase mb-3">Filters</h2>
            <div class="mb-4">
                <p class="small fw-bold text-uppercase mb-2">Category</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ $shopQuery(['category' => 'all']) }}" class="btn {{ request('category', 'all') === 'all' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">All</a>
                    <a href="{{ $shopQuery(['category' => 'single-origin']) }}" class="btn {{ request('category') === 'single-origin' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Single Origin</a>
                    <a href="{{ $shopQuery(['category' => 'blend']) }}" class="btn {{ request('category') === 'blend' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Blend</a>
                    <a href="{{ $shopQuery(['category' => 'decaf']) }}" class="btn {{ request('category') === 'decaf' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Decaf</a>
                </div>
            </div>
            <div class="mb-4">
                <p class="small fw-bold text-uppercase mb-2">Roast level</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ $shopQuery(['roast' => 'all']) }}" class="btn {{ request('roast', 'all') === 'all' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">All</a>
                    <a href="{{ $shopQuery(['roast' => 'light']) }}" class="btn {{ request('roast') === 'light' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Light</a>
                    <a href="{{ $shopQuery(['roast' => 'medium']) }}" class="btn {{ request('roast') === 'medium' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Medium</a>
                    <a href="{{ $shopQuery(['roast' => 'dark']) }}" class="btn {{ request('roast') === 'dark' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Dark</a>
                </div>
            </div>
            <div>
                <p class="small fw-bold text-uppercase mb-2">Origin</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ $shopQuery(['origin' => 'all']) }}" class="btn {{ request('origin', 'all') === 'all' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">All</a>
                    <a href="{{ $shopQuery(['origin' => 'ethiopia']) }}" class="btn {{ request('origin') === 'ethiopia' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Ethiopia</a>
                    <a href="{{ $shopQuery(['origin' => 'colombia']) }}" class="btn {{ request('origin') === 'colombia' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Colombia</a>
                    <a href="{{ $shopQuery(['origin' => 'indonesia']) }}" class="btn {{ request('origin') === 'indonesia' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Indonesia</a>
                    <a href="{{ $shopQuery(['origin' => 'multiple']) }}" class="btn {{ request('origin') === 'multiple' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Multiple</a>
                    <a href="{{ $shopQuery(['origin' => 'costa-rica']) }}" class="btn {{ request('origin') === 'costa-rica' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Costa Rica</a>
                    <a href="{{ $shopQuery(['origin' => 'brazil']) }}" class="btn {{ request('origin') === 'brazil' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Brazil</a>
                    <a href="{{ $shopQuery(['origin' => 'guatemala']) }}" class="btn {{ request('origin') === 'guatemala' ? 'btn-dark' : 'btn-outline-dark' }} rounded-0 small">Guatemala</a>
                </div>
            </div>
        </section>

        <section>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <span class="text-secondary">{{ $products->total() }} {{ $products->total() === 1 ? 'product' : 'products' }}</span>
                <form method="get" action="{{ route('shop') }}" class="d-flex flex-wrap align-items-center gap-2">
                    @foreach (request()->except(['sort', 'page', 'price_min', 'price_max']) as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach
                    <span class="small text-nowrap">Price (€):</span>
                    <input type="number" name="price_min" value="{{ request('price_min') }}" class="form-control form-control-sm rounded-0" style="width: 5.5rem;" min="0" step="0.01" inputmode="decimal" placeholder="From" aria-label="Minimum price">
                    <span class="small text-secondary">–</span>
                    <input type="number" name="price_max" value="{{ request('price_max') }}" class="form-control form-control-sm rounded-0" style="width: 5.5rem;" min="0" step="0.01" inputmode="decimal" placeholder="To" aria-label="Maximum price">
                    <button type="submit" class="btn btn-outline-dark btn-sm rounded-0">Apply</button>
                    <span class="small text-nowrap ms-1">Sort by:</span>
                    <select name="sort" class="form-select form-select-sm rounded-0" style="width: auto; min-width: 11rem;" onchange="this.form.requestSubmit()">
                        <option value="price_asc" @selected(request('sort', 'price_asc') === 'price_asc')>Price: Low to High</option>
                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
                        <option value="name" @selected(request('sort') === 'name')>Name A-Z</option>
                    </select>
                </form>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-0 small mb-4">{{ $errors->first() }}</div>
            @endif
            @if (session('status'))
                <div class="alert alert-success rounded-0 small mb-4">{{ session('status') }}</div>
            @endif

            <div class="row g-4">
                @forelse ($products as $product)
                    @php
                        $thumb = $product->images->first()?->path ?? 'assets/logo.png';
                    @endphp
                    <div class="col-6 col-md-6 col-lg-4">
                        <div class="card border-0 h-100 d-flex flex-column bg-transparent">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="text-decoration-none text-dark flex-grow-1 d-flex flex-column">
                                <div class="ratio ratio-1x1 mb-2"><img src="{{ asset($thumb) }}" alt="{{ $product->name }}" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                                <h3 class="h6 fw-bold mb-1">{{ $product->name }}</h3>
                                <p class="small text-secondary mb-2">{{ $product->category->name }}</p>
                                <p class="small mb-1">Origin: {{ $product->origin_label ?? '—' }}</p>
                                <p class="small mb-1">Roast: {{ ucfirst($product->roast_level) }}</p>
                                <p class="small mb-2">Weight: {{ $product->weight_grams }}g</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto mb-2">
                                    <span class="fw-bold">{{ number_format((float) $product->price, 2, ',', ' ') }} €</span>
                                </div>
                            </a>
                            <form method="post" action="{{ route('cart.add') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-dark btn-sm rounded-0 small w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-secondary mb-0">No products match your filters.</p>
                    </div>
                @endforelse
            </div>

            {{ $products->withQueryString()->links('vendor.pagination.bootstrap-5') }}
        </section>
    </main>
@push('scripts')
<script>
(function () {
  var key = 'gemini_shop_scroll_y';
  var main = document.querySelector('main[data-shop-scroll-root]');
  if (!main) return;
  var shopPath = main.getAttribute('data-shop-path');
  if (!shopPath) return;
  function isShopHref(href) {
    if (!href) return false;
    try {
      var u = new URL(href, window.location.origin);
      return u.pathname === shopPath;
    } catch (e) {
      return false;
    }
  }
  main.addEventListener('click', function (e) {
    var a = e.target.closest('a[href]');
    if (!a || !isShopHref(a.getAttribute('href'))) return;
    sessionStorage.setItem(key, String(window.scrollY));
  }, true);
  main.addEventListener('submit', function (e) {
    var f = e.target;
    if (!f || f.tagName !== 'FORM' || String(f.method).toLowerCase() !== 'get') return;
    if (!isShopHref(f.getAttribute('action'))) return;
    sessionStorage.setItem(key, String(window.scrollY));
  }, true);
  function restoreScroll() {
    var raw = sessionStorage.getItem(key);
    if (raw === null) return;
    sessionStorage.removeItem(key);
    var y = parseInt(raw, 10);
    if (Number.isNaN(y)) return;
    window.scrollTo(0, y);
    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        window.scrollTo(0, y);
      });
    });
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', restoreScroll);
  } else {
    restoreScroll();
  }
})();
</script>
@endpush
@endsection
