<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body>
        <main id="app">
            <div :class="'main ' + (isLoaded ? 'show' : '')">
                <admin-menu></admin-menu>
{{--                <navigation></navigation>--}}
                <div>
                    <router-view></router-view>
                </div>
            </div>
{{--            <ocean-loader :class="isLoaded ? 'hide' : ''"></ocean-loader>--}}
        </main>

        <script src="/js/app.js"></script>
    </body>
</html>
