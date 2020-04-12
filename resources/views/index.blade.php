<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virac Special</title>

    <? # CSS Bundle ?>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <? # Jquery ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>
<body>

<div id="app" class="main">
    <homepage></homepage>
</div>


<? # JavaScript Bundle ?>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
