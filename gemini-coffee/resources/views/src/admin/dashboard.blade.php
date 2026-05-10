@extends('layouts.app')
@section('title', 'Admin – Product management')
@section('content')
<main class="container py-5">
    <section class="border border-secondary p-4 mb-4">
        <h1 class="h3 fw-bold text-uppercase mb-1">Admin dashboard</h1>
        <p class="text-secondary mb-0">Product management</p>
    </section>

    @if (session('status'))
        <div class="alert alert-success rounded-0 small mb-4">{{ session('status') }}</div>
    @endif

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <p class="mb-0"><span class="text-secondary">Total products:</span> <strong>{{ $products->total() }}</strong></p>
        <a href="{{ route('admin.product.create') }}" class="btn btn-dark rounded-0">+ Add product</a>
    </div>

    <div class="table-responsive border border-secondary">
        <table class="table table-bordered table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Roast</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    @php $thumb = $product->images->first()?->path ?? 'assets/logo.png'; @endphp
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td style="width:60px;">
                            <img src="{{ asset($thumb) }}" alt="{{ $product->name }}" style="width:48px;height:48px;object-fit:cover;">
                        </td>
                        <td class="fw-bold">{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ number_format((float)$product->price, 2, ',', ' ') }} €</td>
                        <td>{{ $product->origin_label ?? '—' }}</td>
                        <td>{{ ucfirst($product->roast_level) }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                               class="btn btn-outline-dark btn-sm rounded-0">Edit</a>
                            <form method="POST" action="{{ route('admin.product.destroy') }}"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete {{ addslashes($product->name) }}?')">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-dark btn-sm rounded-0">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-secondary py-4">No products yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>
</main>
@endsection
