<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', $settings['site_title'])</title>

  <link rel="stylesheet" href="/dist/app.css" type="text/css" media="screen" charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

  @include('partials.metadata')
</head>
<body>
    @if(Session::has('flash_message'))
    <div class="messages">
      {{ Session::get('flash_message') }}
    </div>
    @endif

    @include('partials.navigation')

    <div class="container">
      @yield('content')
    </div>

    @include('partials.footer')

    @include('partials.admin')
  </div>
  </div>

  <script src="/dist/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
