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
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Twitter</a></li>
      </ul>
    </footer>

    <footer class="admin">
      @if(Auth::user() && Auth::user()->hasRole('admin'))
      <h4>Administration</h4>
      <ul>
          <li>{{ link_to_route('candidates.index', 'Candidates') }}</li>
          <li>{{ link_to_route('categories.index', 'Categories') }}</li>
          <li>{{ link_to_route('pages.index', 'Pages') }}</li>
          <li>{{ link_to_route('users.index', 'Users') }}</li>
          <li>{{ link_to_route('settings.index', 'Site Settings') }}</li>
      </ul>
      @endif

      <h4>User</h4>
      <ul>
        @if(Auth::guest())
          <li>{{ link_to_route('users.create', 'Create Account') }}</li>
          <li>{{ link_to_route('login', 'Sign In') }}</li>
        @else
          <li>{{ link_to_route('logout', 'Sign Out') }}</li>
        @endif
      </ul>

    </footer>
  </div>
  </div>

  <script src="/dist/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
