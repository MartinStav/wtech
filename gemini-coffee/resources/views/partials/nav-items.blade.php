<li class="nav-item">
    <a class="nav-link" href="{{ url('/home.php') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('shop') }}">Shop</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
</li>
@guest
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
@else
    @if (auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/src/admin/dashboard.php') }}">Admin</a>
        </li>
    @else
        <li class="nav-item">
            <span class="nav-link text-accent mb-0">{{ auth()->user()->name }}</span>
        </li>
    @endif
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}" class="mb-0">
            @csrf
            <button type="submit" class="nav-link text-accent mb-0 bg-transparent border-0 rounded-0">Logout</button>
        </form>
    </li>
@endguest
