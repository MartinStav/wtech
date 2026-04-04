@extends('layouts.app')
@section('title', 'Admin – Add product')
@section('content')
<main class="container py-5">
        <section class="border border-secondary p-4 mb-4">
            <h1 class="h3 fw-bold text-uppercase mb-1">Add new product</h1>
            <p class="text-secondary mb-0">Create a new coffee product</p>
        </section>

        <form action="{{ url('/src/admin/dashboard.php') }}" method="get">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card rounded-0 border border-secondary mb-4">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Product information</h2>
                            <div class="mb-3">
                                <label for="productName" class="form-label small fw-bold text-uppercase">Product name</label>
                                <input type="text" class="form-control rounded-0" id="productName" placeholder="Ethiopian Yirgacheffe">
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label small fw-bold text-uppercase">Category</label>
                                    <select class="form-select rounded-0" id="category">
                                        <option value="">Select category</option>
                                        <option>Single Origin</option>
                                        <option>Blend</option>
                                        <option>Decaf</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label small fw-bold text-uppercase">Price (€)</label>
                                    <input type="text" class="form-control rounded-0" id="price" placeholder="18,99">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="origin" class="form-label small fw-bold text-uppercase">Origin</label>
                                    <input type="text" class="form-control rounded-0" id="origin" placeholder="Ethiopia">
                                </div>
                                <div class="col-md-4">
                                    <label for="roast" class="form-label small fw-bold text-uppercase">Roast level</label>
                                    <select class="form-select rounded-0" id="roast">
                                        <option>Light</option>
                                        <option>Medium</option>
                                        <option>Dark</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="weight" class="form-label small fw-bold text-uppercase">Weight</label>
                                    <input type="text" class="form-control rounded-0" id="weight" placeholder="250g">
                                </div>
                            </div>
                            <div class="mb-0">
                                <label for="description" class="form-label small fw-bold text-uppercase">Description</label>
                                <textarea class="form-control rounded-0" id="description" rows="5" placeholder="Describe the coffee's flavor profile and characteristics..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-0 border border-secondary">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Product images</h2>
                            <div class="mb-3">
                                <label for="images" class="form-label small fw-bold text-uppercase">Upload images</label>
                                <input type="file" class="form-control rounded-0" id="images" multiple accept=".jpg,.jpeg,.png">
                                <p class="form-text small text-secondary mb-0">Upload up to 5 images. JPG, PNG formats supported.</p>
                            </div>
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary d-flex align-items-center justify-content-center small text-secondary">Slot 1</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary d-flex align-items-center justify-content-center small text-secondary">Slot 2</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary d-flex align-items-center justify-content-center small text-secondary">Slot 3</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary d-flex align-items-center justify-content-center small text-secondary">Slot 4</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card rounded-0 border border-secondary mb-4">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Actions</h2>
                            <button type="submit" class="btn btn-dark w-100 rounded-0 mb-2">Save product</button>
                            <a href="{{ url('/src/admin/dashboard.php') }}" class="btn btn-outline-dark w-100 rounded-0">Cancel</a>
                        </div>
                    </div>
                    <div class="card rounded-0 border border-secondary">
                        <div class="card-body">
                            <h2 class="h6 fw-bold text-uppercase mb-3">Preview</h2>
                            <dl class="row small mb-0">
                                <dt class="col-5 text-secondary">Status</dt>
                                <dd class="col-7 mb-2">Draft</dd>
                                <dt class="col-5 text-secondary">Visibility</dt>
                                <dd class="col-7 mb-0">Public</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
