<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', $settings['site_title'])</title>

  <link rel="stylesheet" href="/dist/app.css" type="text/css" media="screen" charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
</head>
<body>
    @if(Session::has('flash_message'))
    <div class="messages">
      {{ Session::get('flash_message') }}
    </div>
    @endif
    <nav class="primary">
      <a class="logo" href="{{{ route('home') }}}"><img src="/dist/images/logo.png" alt="Celebs Gone Good"></a>
      <ul>
        @forelse(Category::all() as $category)
        <li>{{ highlighted_link_to_route('categories.show', $category->name, [$category->slug]) }}</li>
        @empty
        <li>No categories.</li>
        @endforelse

        <li><a href="#">Write In</a></li> {{-- @TODO: Link to write-in form. --}}
      </ul>
    </nav>

    <div class="container">
      <div class="wrapper">
        @yield('content')
      </div>
    </div>

    <footer class="primary">
      {{ $settings['site_title'] }} is a program of <a href="https://www.dosomething.org">DoSomething.org</a>.

      <ul class="footer__links">
        <li><a class="footer__link -facebook" href="#"><span>Facebook</span></a></li>
        <li><a class="footer__link -twitter" href="#"><span>Twitter</span></a></li>
        <li><a  href="{{ $settings['faq_link_url'] }}">{{ $settings['faq_link_text'] }}</a></li>
      </ul>
    </footer>

    @include('partials.admin')
  </div>
  </div>

  <script src="/dist/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
