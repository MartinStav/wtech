@extends('layouts.app')
@section('title', 'Brazilian Santos - Premium coffee beans')
@section('content')
<main class="container py-5">
        <a href="{{ url('/src/public/shop.php') }}" class="text-decoration-none text-dark d-inline-flex align-items-center gap-1 mb-4">
            <span>←</span> Back to Shop
        </a>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="ratio ratio-1x1 mb-2">
                    <img src="{{ asset('assets/brazilian.png') }}" alt="Brazilian Santos" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                </div>
                <div class="d-flex gap-2">
                    <div class="ratio ratio-1x1 flex-grow-1"><img src="{{ asset('assets/brazilian.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                    <div class="ratio ratio-1x1 flex-grow-1"><img src="{{ asset('assets/brazilianIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                    <div class="ratio ratio-1x1 flex-grow-1"><img src="{{ asset('assets/columbian_supremo.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                    <div class="ratio ratio-1x1 flex-grow-1"><img src="{{ asset('assets/costaIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge bg-dark rounded-0 mb-2">Single Origin</span>
                <h1 class="h2 fw-bold mb-2">Brazilian Santos</h1>
                <p class="h3 fw-bold mb-4">15,99 €</p>

                <hr class="my-4">
                <div class="small fw-bold text-uppercase mb-2">Specs</div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-secondary">Origin:</span>
                    <span>Brazil</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-secondary">Roast:</span>
                    <span>Medium</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-secondary">Weight:</span>
                    <span>250g</span>
                </div>

                <hr class="my-4">
                <div class="small fw-bold text-uppercase mb-2">Description</div>
                <p class="mb-4">Mild and sweet with nutty undertones. Low acidity and smooth finish.</p>

                <div class="small fw-bold text-uppercase mb-2">Quantity</div>
                <div class="d-flex align-items-center gap-2 mb-4">
                    <button type="button" class="btn btn-outline-dark rounded-0">−</button>
                    <input type="number" class="form-control rounded-0 text-center" value="1" min="1" style="max-width: 80px;">
                    <button type="button" class="btn btn-outline-dark rounded-0">+</button>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark rounded-0">Add to Cart</button>
                    <button type="button" class="btn btn-outline-dark rounded-0">Buy Now</button>
                </div>
            </div>
        </div>
    </main>
@endsection
