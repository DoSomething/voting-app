<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>@yield('title', setting('site_title'))</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset(setting('favicon', 'assets/images/favicon.default.ico')) }}">
    <link rel="apple-touch-icon" href="{{ asset(setting('touch_icon', 'assets/images/touch_icon.default.png')) }}">

    @include('partials.styles')

    @include('partials.scripts')

    @include('partials.metadata')
</head>
<body>
    <!--[if lte IE 8]>
        <div class='ie-upgrade'>
            <p>You're running an older web browser, so we can't guarantee that everything on <strong>{{ setting('site_title') }}</strong> will work correctly.</p>
            <p><a href="http://whatbrowser.org/">Click here</a> to learn how to upgrade your web browser.</p>
        </div>
    <![endif]-->

    @include('partials.admin')

    @include('partials.navigation')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')

    @include('partials.analytics')
</body>
</html>
