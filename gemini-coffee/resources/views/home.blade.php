@extends('layouts.app')
@section('title', 'Premium coffee beans')
@section('content')
<main>
        <section class="hero-block d-flex align-items-center">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-7 col-xl-6 text-start">
                        <h1 class="display-4 fw-bold mb-3 text-accent text-uppercase hero-title">Premium coffee beans</h1>
                        <p class="lead mb-4">Ethically sourced, expertly roasted, delivered fresh</p>
                        <a href="{{ route('shop') }}" class="btn btn-accent btn-lg rounded-0 px-4 text-uppercase">Shop now</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-y">
            <div class="container text-center">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4 p-4">
                        <p class="display-5 fw-bold mb-2 text-accent">01</p>
                        <h2 class="h6 fw-bold mb-2 text-accent">Free shipping</h2>
                        <p class="text-white-50 mb-0">On orders over 50 €</p>
                    </div>
                    <div class="col-md-4 p-4">
                        <p class="display-5 fw-bold mb-2 text-accent">02</p>
                        <h2 class="h6 fw-bold mb-2 text-accent">Fresh roasted</h2>
                        <p class="text-white-50 mb-0">Roasted weekly in small batches</p>
                    </div>
                    <div class="col-md-4 p-4">
                        <p class="display-5 fw-bold mb-2 text-accent">03</p>
                        <h2 class="h6 fw-bold mb-2 text-accent">Quality guarantee</h2>
                        <p class="text-white-50 mb-0">100% satisfaction or money back</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-y-tight">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3 py-3">
                        <p class="h3 fw-bold mb-1 text-accent">10K+</p>
                        <p class="text-uppercase small mb-0 text-white-50">Happy customers</p>
                    </div>
                    <div class="col-md-3 py-3">
                        <p class="h3 fw-bold mb-1 text-accent">50+</p>
                        <p class="text-uppercase small mb-0 text-white-50">Coffee origins</p>
                    </div>
                    <div class="col-md-3 py-3">
                        <p class="h3 fw-bold mb-1 text-accent">100%</p>
                        <p class="text-uppercase small mb-0 text-white-50">Organic certified</p>
                    </div>
                    <div class="col-md-3 py-3">
                        <p class="h3 fw-bold mb-1 text-accent">24/7</p>
                        <p class="text-uppercase small mb-0 text-white-50">Customer support</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="our-story-section">
            <div class="container-fluid px-0">
                <div class="row g-0 align-items-stretch">
                    <div class="col-12 col-md-6 p-0">
                        <div class="story-img-holder">
                            <img src="{{ asset('assets/story.png') }}" alt="Our roastery and craft" class="story-img">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 our-story-text d-flex align-items-center">
                        <div class="p-4 p-lg-5 w-100">
                            <h2 class="mb-3 text-accent">Our story</h2>
                            <p class="mb-3">
                                We source the finest coffee beans from around the world and roast them to perfection. Our commitment to quality and sustainability drives everything we do.
                            </p>
                            <p class="mb-4">
                                Each batch is carefully crafted to bring out unique flavor profiles that coffee enthusiasts love. From bean selection to final roast, every step is executed with precision.
                            </p>
                            <a href="#" class="btn btn-outline-accent rounded-0 text-uppercase">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-y">
            <div class="container">
                <h2 class="text-center mb-5 text-accent">How it works</h2>
                <div class="row g-4 text-center">
                    <div class="col-md-6 col-lg-3">
                        <div class="how-step-num mx-auto d-flex align-items-center justify-content-center mb-3">
                            <p class="h2 fw-bold text-accent mb-0">1</p>
                        </div>
                        <h3 class="h6 mb-2 text-accent text-uppercase">Choose</h3>
                        <p class="small text-secondary mb-0">Browse our selection of premium beans</p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="how-step-num mx-auto d-flex align-items-center justify-content-center mb-3">
                            <p class="h2 fw-bold text-accent mb-0">2</p>
                        </div>
                        <h3 class="h6 mb-2 text-accent text-uppercase">Order</h3>
                        <p class="small text-secondary mb-0">Place your order online in minutes</p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="how-step-num mx-auto d-flex align-items-center justify-content-center mb-3">
                            <p class="h2 fw-bold text-accent mb-0">3</p>
                        </div>
                        <h3 class="h6 mb-2 text-accent text-uppercase">Roast</h3>
                        <p class="small text-secondary mb-0">We roast to order for maximum freshness</p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="how-step-num mx-auto d-flex align-items-center justify-content-center mb-3">
                            <p class="h2 fw-bold text-accent mb-0">4</p>
                        </div>
                        <h3 class="h6 mb-2 text-accent text-uppercase">Enjoy</h3>
                        <p class="small text-secondary mb-0">Delivered fresh to your door</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-y">
            <div class="container">
                <h2 class="mb-5 text-accent text-start text-center">Featured products</h2>
                <div class="row g-4">
                    @foreach ($featuredProducts as $product)
                    @php $thumb = $product->images->first()?->path ?? 'assets/logo.png'; @endphp
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
                    @endforeach
                    <div class="col-6 col-md-6 col-lg-4 d-flex align-items-center justify-content-center py-md-5">
                        <a href="{{ route('shop') }}" class="text-decoration-none text-accent text-center">
                            <div class="fs-2 lh-1 mb-3">→</div>
                            <span class="d-block text-uppercase small fw-bold">View all products</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-y">
            <div class="container">
            <h2 class="text-center mb-5 text-accent">Customer reviews</h2>
            <div class="row g-4">
                <div class="col-md-4 p-4 text-start">
                    <img src="{{ asset('assets/review_starts.png') }}" alt="" class="img-fluid mb-3 review-stars">
                    <p class="mb-3">Best coffee I've ever had. The Ethiopian blend is absolutely incredible. Fresh roast quality you can taste.</p>
                    <p class="fw-bold text-uppercase text-accent mb-0">- Sarah Mitchell</p>
                </div>
                <div class="col-md-4 p-4 text-start">
                    <img src="{{ asset('assets/review_starts.png') }}" alt="" class="img-fluid mb-3 review-stars">
                    <p class="mb-3">Amazing service and quality. The coffee arrives fresh and the flavor is consistently excellent every time.</p>
                    <p class="fw-bold text-uppercase text-accent mb-0">- James Rodriguez</p>
                </div>
                <div class="col-md-4 p-4 text-start">
                    <img src="{{ asset('assets/review_starts.png') }}" alt="" class="img-fluid mb-3 review-stars">
                    <p class="mb-3">Love the subscription service! Never run out of coffee and the quality is always top notch. Highly recommend.</p>
                    <p class="fw-bold text-uppercase text-accent mb-0">- Emma Chen</p>
                </div>
            </div>
            </div>
        </section>
        <section class="section-y">
            <div class="container">
            <h2 class="text-center mb-5 text-accent">Why choose us</h2>
            <div class="row g-4">
                <div class="col-md-6 d-flex gap-3">
                    <img src="{{ asset('assets/checkmark.png') }}" alt="" width="48" height="48" class="flex-shrink-0">
                    <div>
                        <h3 class="h6 fw-bold text-accent mb-1">Ethical sourcing</h3>
                        <p class="mb-0">We work directly with farmers to ensure fair trade practices and sustainable farming methods.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex gap-3">
                    <img src="{{ asset('assets/checkmark.png') }}" alt="" width="48" height="48" class="flex-shrink-0">
                    <div>
                        <h3 class="h6 fw-bold text-accent mb-1">Expert roasting</h3>
                        <p class="mb-0">Our master roasters have decades of experience crafting the perfect roast profile for each origin.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex gap-3">
                    <img src="{{ asset('assets/checkmark.png') }}" alt="" width="48" height="48" class="flex-shrink-0">
                    <div>
                        <h3 class="h6 fw-bold text-accent mb-1">Small batch</h3>
                        <p class="mb-0">We roast in small batches to maintain quality control and ensure peak freshness.</p>
                    </div>
                </div>
                <div class="col-md-6 d-flex gap-3">
                    <img src="{{ asset('assets/checkmark.png') }}" alt="" width="48" height="48" class="flex-shrink-0">
                    <div>
                        <h3 class="h6 fw-bold text-accent mb-1">Fast shipping</h3>
                        <p class="mb-0">Orders ship within 24 hours so you get your coffee at its absolute freshest.</p>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="section-y">
            <div class="container">
            <h2 class="text-center mb-5 text-accent">Follow us on Instagram</h2>
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/brazilianIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/columbianIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/costaIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/decafIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/espressoIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/ethiopianIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/sopkaIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
                <div class="col-6 col-lg-3"><div class="ratio ratio-1x1"><img src="{{ asset('assets/kvetinkyIG.png') }}" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"></div></div>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-outline-accent rounded-0 text-uppercase small">@@coffeeshop</a>
            </div>
            </div>
        </section>
        <section class="section-y-lg border-bottom">
            <div class="container">
            <h2 class="text-center mb-3 text-accent">Subscribe to our newsletter</h2>
            <p class="text-center mb-4">Get exclusive offers and brewing tips delivered to your inbox</p>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="row g-2 newsletter-form">
                        <div class="col-12 col-lg-8">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="col-12 col-lg-4">
                            <button class="btn btn-accent w-100 rounded-0 text-uppercase small" type="submit">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
