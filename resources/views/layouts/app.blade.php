<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url" content="https://viracspecial.com" />
    <meta property="og:title" content="Virac Special" />
    <meta property="og:description" content="What to find in Virac, a small, rustic and quaint town on the coast of Catanduanes Island.  Explore its charm, get a glimpse of its culture and people" />
    <meta property="og:image" content="/images/Slides/Boulevard.jpg" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Virac Special')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if (Auth::check())
        <script src="{{ config('cdn.ckeditor-js')  }}"></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Muli:300|Patua+One" rel="stylesheet">    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<body>
    <div id="app">
        <navigation></navigation>
        {{-- Form Messages --}}
        @include('admin.notifications.form-messages')

        @yield('content')

        <foot></foot>
    </div>

    {{--  Jquery for Admin Side  --}}
    @if (Auth::check())
        <script src="{{ config('cdn.jquery') }}"></script>
        @include('auth.nav')
    @endif
</body>
</html>
