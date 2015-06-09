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
        html { background-image: url('{{ background('regular', 'none') }}'); }
        @media (min-width: 1200px) {
            html { background-image: url('{{ background('retina', 'none') }}'); }
        }

        @if(setting('ui_tint'))
            h1.highlighted, h2.highlighted, h3.highlighted { background-color: {{ setting('ui_tint') }} !important; }

            a, a:hover, a:active { color: {{ setting('ui_tint') }}; }
            .button.-primary, .button.-primary:hover, .button.-primary:active {
                color: #000 !important;
                background-color: {{ setting('ui_tint') }} !important;
            }
            .button.-secondary, .button.-secondary:hover, .button.-secondary:active {
                color: {{ setting('ui_tint') }} !important;
                background-color: transparent !important;
            }
            .button.-round, .button.-round:hover, .button.-round:active { background-color: {{ setting('ui_tint') }} !important; }

            .messages { color: {{ setting('ui_tint') }} !important; }

            input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus,
            input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus,
            input[type="url"]:focus, input[type="color"]:focus, input[type="date"]:focus,
            input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="month"]:focus,
            input[type="time"]:focus, input[type="week"]:focus, textarea:focus {
                border-color: {{ setting('ui_tint') }} !important;
            }
        @endif
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
