<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CG Park | @yield('page_title', __('home.page_title'))</title>
    <meta name="description" content="@yield('meta_description', __('home.page_description'))">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|manrope:500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    @stack('styles')
</head>
<body class="@yield('body_class', app()->getLocale() === 'ar' ? 'is-rtl' : '')">
    <div class="page-shell">
        @include('partials.site-header')

        <main>
            @yield('content')
        </main>

        @include('partials.site-footer')
    </div>

    <script src="{{ asset('js/home.js') }}"></script>
    @stack('scripts')
</body>
</html>
