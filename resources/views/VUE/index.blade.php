<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.laravel = { csrfToken: '{{ csrf_token() }}'}</script>
    <!-- CSRF Token -->
    <title>{{ config('app.name', 'Laravel') }} vue version</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <div id="app">
            <NavBar></NavBar>
        <div class="container">
            <articles></articles>
        </div>
    </div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

