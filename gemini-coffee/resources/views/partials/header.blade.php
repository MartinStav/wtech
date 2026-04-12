<header class="sticky-top bg-black">
    <nav class="container navbar navbar-expand-lg navbar-dark py-3">
        <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ url('/home.php') }}">
            <img src="{{ asset('assets/logo.png') }}" alt="" width="40" height="40">
            <span class="brand-name text-accent">Gemini Coffee</span>
        </a>

        <ul class="navbar-nav ms-auto d-none d-lg-flex flex-row align-items-center gap-1">
            @include('partials.nav-items')
        </ul>

        <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto">
                    @include('partials.nav-items')
                </ul>
            </div>
        </div>
    </nav>
</header>
