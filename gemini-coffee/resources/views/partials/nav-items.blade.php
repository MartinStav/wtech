<li class="nav-item">
    <a class="nav-link" href="{{ url('/home.php') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/src/public/shop.php') }}">Shop</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/src/order/basket.php') }}">Cart</a>
</li>
@guest
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/src/auth/login.php') }}">Login</a>
    </li>
@else
    <li class="nav-item">
        <span class="nav-link text-accent mb-0">{{ auth()->user()->role ?? auth()->user()->name }}</span>
    </li>
    @if (auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/src/admin/dashboard.php') }}">Admin</a>
        </li>
    @endif
@endguest
