@extends('layouts.app')
@section('title', 'Admin – Edit product')
@section('content')
<main class="container py-5">
        <section class="border border-secondary p-4 mb-4">
            <h1 class="h3 fw-bold text-uppercase mb-1">Edit product</h1>
            <p class="text-secondary mb-0">Update product information</p>
        </section>

        <form action="{{ url('/src/admin/dashboard.php') }}" method="get">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card rounded-0 border border-secondary mb-4">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Product information</h2>
                            <div class="mb-3">
                                <label for="productName" class="form-label small fw-bold text-uppercase">Product name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-0" id="productName" value="Colombian Supremo" required>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label small fw-bold text-uppercase">Category <span class="text-danger">*</span></label>
                                    <select class="form-select rounded-0" id="category" required>
                                        <option>Single Origin</option>
                                        <option>Blend</option>
                                        <option>Decaf</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label small fw-bold text-uppercase">Price (€) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" id="price" value="16,99" required>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="origin" class="form-label small fw-bold text-uppercase">Origin <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" id="origin" value="Colombia" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="roast" class="form-label small fw-bold text-uppercase">Roast level <span class="text-danger">*</span></label>
                                    <select class="form-select rounded-0" id="roast" required>
                                        <option>Light</option>
                                        <option selected>Medium</option>
                                        <option>Dark</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="weight" class="form-label small fw-bold text-uppercase">Weight <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" id="weight" value="250g" required>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label for="description" class="form-label small fw-bold text-uppercase">Description</label>
                                <textarea class="form-control rounded-0" id="description" rows="5" placeholder="Product description..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-0 border border-secondary">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Product images</h2>
                            <p class="small text-secondary mb-3">Current images</p>
                            <div class="row g-2 mb-4">
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary bg-light d-flex align-items-center justify-content-center small">×</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary bg-light d-flex align-items-center justify-content-center small">×</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary bg-light d-flex align-items-center justify-content-center small">×</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary bg-light d-flex align-items-center justify-content-center small">×</div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <label for="newImages" class="form-label small fw-bold text-uppercase">Upload new images</label>
                                <input type="file" class="form-control rounded-0" id="newImages" multiple accept=".jpg,.jpeg,.png">
                                <p class="form-text small text-secondary mb-0">Upload additional images. JPG, PNG formats supported.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card rounded-0 border border-secondary mb-4">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Actions</h2>
                            <button type="submit" class="btn btn-dark w-100 rounded-0 mb-2">Update product</button>
                            <a href="{{ url('/src/admin/dashboard.php') }}" class="btn btn-outline-dark w-100 rounded-0">Cancel</a>
                        </div>
                    </div>
                    <div class="card rounded-0 border border-secondary">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Product info</h2>
                            <dl class="row small mb-0">
                                <dt class="col-5 text-secondary">ID</dt>
                                <dd class="col-7 mb-2">2</dd>
                                <dt class="col-5 text-secondary">Status</dt>
                                <dd class="col-7 mb-2">Active</dd>
                                <dt class="col-5 text-secondary">Created</dt>
                                <dd class="col-7 mb-0">01/01/2024</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
