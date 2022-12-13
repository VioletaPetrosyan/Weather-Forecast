<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Weather Forecast') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body>

<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            @if(!auth()->check())
                <li class="nav-item"><a href="{{ route('register.form') }}" class="nav-link">Signup</a></li>
                <li class="nav-item"><a href="{{ route('login.form') }}" class="nav-link">Login</a></li>
            @else
            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
            @endif
        </ul>
    </header>
</div>

<div id="app">
    <div class="py-4">
        @yield('content')
    </div>
</div>
<script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
