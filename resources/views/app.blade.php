<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>@yield('title', setting('site_title'))</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset(setting('favicon', 'assets/images/favicon.default.ico')) }}">
    <link rel="apple-touch-icon" href="{{ asset(setting('touch_icon', 'assets/images/touch_icon.default.png')) }}">

    <!--[if lte IE 8]>
    <script src="{{ asset('/assets/vendor/html5shiv.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/respond.min.js') }}"></script>
    <![endif]-->

    <style>
        html {
            background-image: url('{{ background('regular', 'none') }}');
        }

        @media (min-width: 1200px) {
            html {
                background-image: url('{{ background('retina', 'none') }}');
            }
        }
    </style>

    @include('partials.metadata')
</head>
<body>
@include('partials.admin')
@include('partials.navigation')

<div class="container">
    @yield('content')
</div>

@include('partials.footer')

<script src="{{ asset('/js/bundle.js') }}" type="text/javascript" charset="utf-8"></script>

@include('partials.analytics')
</body>
</html>
