<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.header')
    @yield('content')
    @unless (request()->is('src/auth/*', 'src/admin/*', 'src/order/*'))
        @include('partials.footer')
    @endunless
    @stack('scripts')
</body>
</html>
