@extends('layouts.app')
@section('title', 'Admin – Add product')
@section('content')
<main class="container py-5">
    <section class="border border-secondary p-4 mb-4">
        <h1 class="h3 fw-bold text-uppercase mb-1">Add new product</h1>
        <p class="text-secondary mb-0">Create a new coffee product</p>
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

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card rounded-0 border border-secondary mb-4">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Product information</h2>
                        <div class="mb-3">
                            <label for="productName" class="form-label small fw-bold text-uppercase">Product name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror"
                                   id="productName" name="name" value="{{ old('name') }}"
                                   placeholder="Ethiopian Yirgacheffe" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="category_id" class="form-label small fw-bold text-uppercase">Category <span class="text-danger">*</span></label>
                                <select class="form-select rounded-0 @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id" required>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label small fw-bold text-uppercase">Price (€) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0"
                                       class="form-control rounded-0 @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price') }}"
                                       placeholder="18.99" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="origin_label" class="form-label small fw-bold text-uppercase">Origin</label>
                                <input type="text" class="form-control rounded-0 @error('origin_label') is-invalid @enderror"
                                       id="origin_label" name="origin_label" value="{{ old('origin_label') }}"
                                       placeholder="Ethiopia">
                                @error('origin_label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="roast_level" class="form-label small fw-bold text-uppercase">Roast level <span class="text-danger">*</span></label>
                                <select class="form-select rounded-0 @error('roast_level') is-invalid @enderror"
                                        id="roast_level" name="roast_level" required>
                                    <option value="light"  @selected(old('roast_level') === 'light')>Light</option>
                                    <option value="medium" @selected(old('roast_level', 'medium') === 'medium')>Medium</option>
                                    <option value="dark"   @selected(old('roast_level') === 'dark')>Dark</option>
                                </select>
                                @error('roast_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="weight_grams" class="form-label small fw-bold text-uppercase">Weight (g) <span class="text-danger">*</span></label>
                                <input type="number" min="1"
                                       class="form-control rounded-0 @error('weight_grams') is-invalid @enderror"
                                       id="weight_grams" name="weight_grams" value="{{ old('weight_grams', 250) }}"
                                       placeholder="250" required>
                                @error('weight_grams')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label small fw-bold text-uppercase">Stock quantity</label>
                            <input type="number" min="0"
                                   class="form-control rounded-0 @error('stock_quantity') is-invalid @enderror"
                                   id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 100) }}">
                            @error('stock_quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-0">
                            <label for="description" class="form-label small fw-bold text-uppercase">Description</label>
                            <textarea class="form-control rounded-0 @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="5"
                                      placeholder="Describe the coffee's flavor profile and characteristics...">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="card rounded-0 border border-secondary">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Product images</h2>
                        <div class="mb-3">
                            <label for="images" class="form-label small fw-bold text-uppercase">Upload images</label>
                            <input type="file" class="form-control rounded-0 @error('images.*') is-invalid @enderror"
                                   id="images" name="images[]" multiple accept=".jpg,.jpeg,.png">
                            <p class="form-text small text-secondary mb-0">Upload up to 5 images. JPG, PNG formats supported. Max 5 MB each.</p>
                            @error('images.*')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="row g-2" id="imagePreviewRow">
                            @for ($s = 0; $s < 4; $s++)
                                <div class="col-6 col-md-3">
                                    <div class="ratio ratio-1x1 border border-secondary d-flex align-items-center justify-content-center small text-secondary image-slot" data-slot="{{ $s }}">
                                        Slot {{ $s + 1 }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card rounded-0 border border-secondary mb-4">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Actions</h2>
                        <button type="submit" class="btn btn-dark w-100 rounded-0 mb-2">Save product</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark w-100 rounded-0">Cancel</a>
                    </div>
                </div>
                <div class="card rounded-0 border border-secondary">
                    <div class="card-body">
                        <h2 class="h6 fw-bold text-uppercase mb-3">Preview</h2>
                        <dl class="row small mb-0">
                            <dt class="col-5 text-secondary">Status</dt>
                            <dd class="col-7 mb-2">Active</dd>
                            <dt class="col-5 text-secondary">Visibility</dt>
                            <dd class="col-7 mb-0">Public</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@push('scripts')
<script>
document.getElementById('images').addEventListener('change', function () {
    var slots = document.querySelectorAll('.image-slot');
    Array.from(this.files).slice(0, slots.length).forEach(function (file, i) {
        var reader = new FileReader();
        reader.onload = function (e) {
            slots[i].innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
@endsection
