@extends('layouts.app')
@section('title', 'Shopping cart - Premium coffee beans')
@section('content')
<main class="container py-5">
        <h1 class="h2 fw-bold mb-4">Shopping cart</h1>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="border p-5 text-center">
                    <div class="bg-light ratio ratio-1x1 mx-auto mb-4" style="max-width: 120px;"></div>
                    <h2 class="h5 fw-bold mb-2">Cart is empty</h2>
                    <p class="text-secondary mb-4">Add products to get started</p>
                    <a href="{{ url('/src/public/shop.php') }}" class="btn btn-dark rounded-0">Browse products</a>
                </div>
            </div>
        </div>
    </main>
@endsection
