<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if (Auth::check())
        <script src="{{ config('cdn.ckeditor-js')  }}"></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;700;800&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if(!Auth::check() && !Request::is('login'))
        <navigation></navigation>
        @endif

        {{-- Form Messages --}}
        @include('admin.notifications.form-messages')

            <div class="content-mt">
                @yield('content')
            </div>
    </div>

    {{--  Jquery for Admin Side  --}}
    @if (Auth::check())
        <script src="{{ config('cdn.jquery') }}"></script>
    @endif
</body>
</html>
