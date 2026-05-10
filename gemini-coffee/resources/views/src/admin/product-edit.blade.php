@extends('layouts.app')
@section('title', 'Admin – Edit product')
@section('content')
<main class="container py-5">
    <section class="border border-secondary p-4 mb-4">
        <h1 class="h3 fw-bold text-uppercase mb-1">Edit product</h1>
        <p class="text-secondary mb-0">Update product information</p>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger rounded-0 small mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card rounded-0 border border-secondary mb-4">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Product information</h2>
                        <div class="mb-3">
                            <label for="productName" class="form-label small fw-bold text-uppercase">Product name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror"
                                   id="productName" name="name"
                                   value="{{ old('name', $product->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="category_id" class="form-label small fw-bold text-uppercase">Category <span class="text-danger">*</span></label>
                                <select class="form-select rounded-0 @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            @selected(old('category_id', $product->category_id) == $cat->id)>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label small fw-bold text-uppercase">Price (€) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0"
                                       class="form-control rounded-0 @error('price') is-invalid @enderror"
                                       id="price" name="price"
                                       value="{{ old('price', $product->price) }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="origin_label" class="form-label small fw-bold text-uppercase">Origin</label>
                                <input type="text" class="form-control rounded-0 @error('origin_label') is-invalid @enderror"
                                       id="origin_label" name="origin_label"
                                       value="{{ old('origin_label', $product->origin_label) }}">
                                @error('origin_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="roast_level" class="form-label small fw-bold text-uppercase">Roast level <span class="text-danger">*</span></label>
                                <select class="form-select rounded-0 @error('roast_level') is-invalid @enderror"
                                        id="roast_level" name="roast_level" required>
                                    <option value="light"  @selected(old('roast_level', $product->roast_level) === 'light')>Light</option>
                                    <option value="medium" @selected(old('roast_level', $product->roast_level) === 'medium')>Medium</option>
                                    <option value="dark"   @selected(old('roast_level', $product->roast_level) === 'dark')>Dark</option>
                                </select>
                                @error('roast_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="weight_grams" class="form-label small fw-bold text-uppercase">Weight (g) <span class="text-danger">*</span></label>
                                <input type="number" min="1"
                                       class="form-control rounded-0 @error('weight_grams') is-invalid @enderror"
                                       id="weight_grams" name="weight_grams"
                                       value="{{ old('weight_grams', $product->weight_grams) }}" required>
                                @error('weight_grams')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label small fw-bold text-uppercase">Stock quantity</label>
                            <input type="number" min="0"
                                   class="form-control rounded-0 @error('stock_quantity') is-invalid @enderror"
                                   id="stock_quantity" name="stock_quantity"
                                   value="{{ old('stock_quantity', $product->stock_quantity) }}">
                            @error('stock_quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-0">
                            <label for="description" class="form-label small fw-bold text-uppercase">Description</label>
                            <textarea class="form-control rounded-0 @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="5"
                                      placeholder="Product description...">{{ old('description', $product->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="card rounded-0 border border-secondary">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Product images</h2>

                        @if ($product->images->isNotEmpty())
                            <p class="small fw-bold text-uppercase mb-2">Current images</p>
                            <div class="row g-2 mb-4">
                                @foreach ($product->images as $img)
                                    <div class="col-6 col-md-3">
                                        <div class="position-relative">
                                            <img src="{{ asset($img->path) }}" alt="Product image"
                                                 class="w-100 border border-secondary"
                                                 style="height:120px;object-fit:cover;">
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox"
                                                       name="remove_images[]" value="{{ $img->id }}"
                                                       id="remove_{{ $img->id }}">
                                                <label class="form-check-label small text-danger" for="remove_{{ $img->id }}">Remove</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="small text-secondary mb-3">No images yet.</p>
                        @endif

                        <div class="mb-0">
                            <label for="newImages" class="form-label small fw-bold text-uppercase">Upload new images</label>
                            <input type="file" class="form-control rounded-0 @error('images.*') is-invalid @enderror"
                                   id="newImages" name="images[]" multiple accept=".jpg,.jpeg,.png">
                            <p class="form-text small text-secondary mb-0">JPG, PNG. Max 5 MB each.</p>
                            @error('images.*')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-0 border border-secondary mb-4">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Actions</h2>
                        <button type="submit" class="btn btn-dark w-100 rounded-0 mb-2">Update product</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark w-100 rounded-0">Cancel</a>
                    </div>
                </div>
                <div class="card rounded-0 border border-secondary">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Product info</h2>
                        <dl class="row small mb-0">
                            <dt class="col-5 text-secondary">ID</dt>
                            <dd class="col-7 mb-2">{{ $product->id }}</dd>
                            <dt class="col-5 text-secondary">Status</dt>
                            <dd class="col-7 mb-2">{{ $product->is_active ? 'Active' : 'Inactive' }}</dd>
                            <dt class="col-5 text-secondary">Created</dt>
                            <dd class="col-7 mb-0">{{ $product->created_at->format('d/m/Y') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
