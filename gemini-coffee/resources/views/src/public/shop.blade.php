@extends('layouts.app')
@section('title', 'Shop - Premium coffee beans')
@section('content')
<main class="container py-5">
        <section class="mb-5">
            <h1 class="h2 fw-bold mb-2">All products</h1>
            <p class="text-secondary mb-0">Browse our complete coffee collection.</p>
        </section>

        <section class="mb-5">
            <h2 class="h6 fw-bold text-uppercase mb-3">Search</h2>
            <input type="search" class="form-control form-control-lg rounded-0" placeholder="Search by name, description, category, origin...">
        </section>

        <section class="mb-5">
            <h2 class="h6 fw-bold text-uppercase mb-3">Filters</h2>
            <div class="mb-4">
                <p class="small fw-bold text-uppercase mb-2">Category</p>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark rounded-0 small">All</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Single Origin</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Blend</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Decaf</button>
                </div>
            </div>
            <div class="mb-4">
                <p class="small fw-bold text-uppercase mb-2">Roast level</p>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark rounded-0 small">All</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Light</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Medium</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Dark</button>
                </div>
            </div>
            <div>
                <p class="small fw-bold text-uppercase mb-2">Origin</p>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-dark rounded-0 small">All</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Ethiopia</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Colombia</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Indonesia</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Multiple</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Costa Rica</button>
                    <button type="button" class="btn btn-outline-dark rounded-0 small">Brazil</button>
                </div>
            </div>
        </section>

        <section>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <span class="text-secondary">8 products</span>
                <div class="d-flex align-items-center gap-2">
                    <span class="small">Sort by:</span>
                    <select class="form-select form-select-sm rounded-0" style="width: auto;">
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Name A-Z</option>
                    </select>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/brazilian.png') }}" alt="Brazilian Santos" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Brazilian Santos</h3>
                        <p class="small text-secondary mb-2">Single Origin</p>
                        <p class="small mb-1">Origin: Brazil</p>
                        <p class="small mb-1">Roast: Medium</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">15,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/columbian_supremo.png') }}" alt="Colombian Supremo" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Colombian Supremo</h3>
                        <p class="small text-secondary mb-2">Single Origin</p>
                        <p class="small mb-1">Origin: Colombia</p>
                        <p class="small mb-1">Roast: Medium</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">16,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/ethiopian_1.png') }}" alt="Ethiopian Yirgacheffe" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Ethiopian Yirgacheffe</h3>
                        <p class="small text-secondary mb-2">Single Origin</p>
                        <p class="small mb-1">Origin: Ethiopia</p>
                        <p class="small mb-1">Roast: Light</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">18,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/costarica.png') }}" alt="Costa Rican Tarrazu" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Costa Rican Tarrazu</h3>
                        <p class="small text-secondary mb-2">Single Origin</p>
                        <p class="small mb-1">Origin: Costa Rica</p>
                        <p class="small mb-1">Roast: Medium</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">18,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/decaf.png') }}" alt="Decaf Colombia" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Decaf Colombia</h3>
                        <p class="small text-secondary mb-2">Decaf</p>
                        <p class="small mb-1">Origin: Colombia</p>
                        <p class="small mb-1">Roast: Medium</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">17,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/espresso_blend.png') }}" alt="Espresso Blend" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Espresso Blend</h3>
                        <p class="small text-secondary mb-2">Blend</p>
                        <p class="small mb-1">Origin: Multiple</p>
                        <p class="small mb-1">Roast: Dark</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">19,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/guatemala.png') }}" alt="Guatemala Antigua Reserve" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Guatemala Antigua Reserve</h3>
                        <p class="small text-secondary mb-2">Single Origin</p>
                        <p class="small mb-1">Origin: Guatemala</p>
                        <p class="small mb-1">Roast: Medium</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">18,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <a href="{{ url('/src/public/product.php') }}" class="card border-0 h-100 d-flex flex-column text-decoration-none">
                        <div class="ratio ratio-1x1 mb-2"><img src="{{ asset('assets/sumatra_mandheling.png') }}" alt="Sumatra Mandheling" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div>
                        <h3 class="h6 fw-bold mb-1">Sumatra Mandheling</h3>
                        <p class="small text-secondary mb-2">Single Origin</p>
                        <p class="small mb-1">Origin: Indonesia</p>
                        <p class="small mb-1">Roast: Medium</p>
                        <p class="small mb-2">Weight: 250g</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fw-bold">19,99 €</span>
                            <button type="button" class="btn btn-dark btn-sm rounded-0 small" onclick="event.preventDefault(); event.stopPropagation();">Add to Cart</button>
                        </div>
                    </a>
                </div>
            </div>

            <nav class="d-flex justify-content-center mt-5 pagination-shop" aria-label="Pagination">
                <ul class="pagination pagination-sm mb-0 gap-2">
                    <li class="page-item disabled"><a class="page-link rounded-0 border" href="#" tabindex="-1">Previous</a></li>
                    <li class="page-item active text-center" style="width: 25px;"><a class="page-link rounded-0 border-0" href="#">1</a></li>
                    <li class="page-item text-center" style="width: 25px;"><a class="page-link rounded-0 border text-dark" href="#">2</a></li>
                    <li class="page-item"><a class="page-link rounded-0 border border-dark text-dark" href="#">Next</a></li>
                </ul>
            </nav>
        </section>
    </main>
@endsection
