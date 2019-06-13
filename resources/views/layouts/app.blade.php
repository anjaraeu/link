<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="box @yield('mainclass')">
            <noscript>
                <p>{{ __('layout.js.tooltip') }}</p>
            </noscript>
            @yield('content')
        </main>
        <footer class="down">
            <a class="item" href="{{ url('legal') }}">{{ __('layout.legal') }}</a>
            <a class="item" href="{{ url('report/create') }}">{{ __('layout.report') }}</a>
            <dark-button v-on:change-theme="switchTheme"></dark-button>
        </footer>
    </div>
</body>
</html>
