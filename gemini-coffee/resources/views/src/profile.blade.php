@extends('layouts.app')
@section('title', 'My profile')
@section('content')
<main class="container py-5">
    <section class="border border-secondary p-4 mb-5">
        <h1 class="h3 fw-bold text-uppercase mb-1">My profile</h1>
        <p class="text-secondary mb-0">{{ $user->email }}</p>
    </section>

    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 fw-bold text-uppercase mb-0">Order history
                <span class="text-secondary fw-normal fs-6">({{ $orders->count() }})</span>
            </h2>
        </div>

        @if ($orders->isEmpty())
            <div class="border border-secondary p-4 text-center">
                <p class="text-secondary mb-0">You have no orders yet.</p>
            </div>
        @else
            <div class="d-flex flex-column gap-3">
                @foreach ($orders as $order)
                    <div class="border p-4">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                            <div>
                                <span class="fw-bold">Order #{{ $order->id }}</span>
                                <span class="text-secondary small ms-2">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="badge rounded-0 bg-dark text-uppercase small">{{ $order->status }}</span>
                                <span class="fw-bold">{{ number_format((float) $order->total, 2, ',', ' ') }} €</span>
                            </div>
                        </div>
                        <div class="text-secondary small mb-3">
                            {{ $order->address_line }}, {{ $order->city }}, {{ $order->postal_code }} &mdash;
                            {{ ucfirst($order->shipping_method) }} shipping
                        </div>
                        <table class="table table-sm mb-0">
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td class="ps-0">{{ $item->product_name }}</td>
                                        <td class="text-secondary">× {{ $item->quantity }}</td>
                                        <td class="text-end pe-0">{{ number_format((float) $item->line_total, 2, ',', ' ') }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <section>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 fw-bold text-uppercase mb-0">Favorite products
                <span class="text-secondary fw-normal fs-6">({{ $favorites->count() }})</span>
            </h2>
            <a href="{{ route('shop') }}" class="btn btn-outline-dark btn-sm rounded-0">Browse shop</a>
        </div>

        @if ($favorites->isEmpty())
            <div class="border border-secondary p-5 text-center">
                <p class="text-secondary mb-3">You have no favorite products yet.</p>
                <a href="{{ route('shop') }}" class="btn btn-dark rounded-0">Start browsing</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($favorites as $product)
                    @php $thumb = $product->images->first()?->path ?? 'assets/logo.png'; @endphp
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card border-0 h-100 d-flex flex-column bg-transparent">
                            <div class="position-relative">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="d-block">
                                    <div class="ratio ratio-1x1 mb-2">
                                        <img src="{{ asset($thumb) }}" alt="{{ $product->name }}"
                                             class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                                    </div>
                                </a>
                                <form method="post" action="{{ route('favorites.toggle') }}"
                                      class="position-absolute top-0 end-0 m-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                            class="border-0 bg-transparent p-0 lh-1 d-block"
                                            title="Remove from favorites">
                                        <span style="font-size:1.5rem;color:#dc3545;filter:drop-shadow(0 1px 2px rgba(0,0,0,0.55));">♥</span>
                                    </button>
                                </form>
                            </div>
                            <a href="{{ route('product.show', ['id' => $product->id]) }}"
                               class="text-decoration-none text-dark flex-grow-1 d-flex flex-column">
                                <h3 class="h6 fw-bold mb-1">{{ $product->name }}</h3>
                                <p class="small text-secondary mb-1">{{ $product->category->name }}</p>
                                <p class="small mb-0 mt-auto fw-bold">{{ number_format((float) $product->price, 2, ',', ' ') }} €</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</main>
@endsection
