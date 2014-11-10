<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ $settings['site_title'] }}</title>

  <link rel="stylesheet" href="/dist/app.css" type="text/css" media="screen" charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
</head>
<body>
  <div class="chrome">
  <div class="chrome--wrapper">
    @if(Session::has('flash_message'))
    <div class="messages">
      {{ Session::get('flash_message') }}
    </div>
    @endif
    <nav class="chrome--nav">
      <a class="logo" href="{{{ route('home') }}}"><img src="/logo.png" alt="Celebs Gone Good"></a>
      <a class="hamburger js-toggle-mobile-menu" href="#">&#xe606;</a>
      <div class="menu">
        <ul class="primary-nav">
          @forelse(Category::all() as $category)
          <li>{{ link_to_route('categories.show', $category->name, [$category->slug]) }}</li>
          @empty
          <li>No categories.</li>
          @endforelse
        </ul>
      </div>
    </nav>

    <div class="container">
      <div class="wrapper">
        @yield('content')
      </div>
    </div>

    <footer class="chrome--footer">

    @if(Auth::user() && Auth::user()->hasRole('admin'))
    <div class="col js-footer-col">
      <h4>Administration</h4>
      <ul>
          <li>{{ link_to_route('candidates.index', 'Candidates') }}</li>
          <li>{{ link_to_route('categories.index', 'Categories') }}</li>
          <li>{{ link_to_route('pages.index', 'Pages') }}</li>
          <li>{{ link_to_route('users.index', 'Users') }}</li>
          <li>{{ link_to_route('settings.index', 'Site Settings') }}</li>
      </ul>
    </div>
    @endif

    <div class="col js-footer-col">
      <h4>User</h4>
      <ul>
        @if(Auth::guest())
          <li>{{ link_to_route('users.create', 'Create Account') }}</li>
          <li>{{ link_to_route('login', 'Sign In') }}</li>
        @else
          <li>{{ link_to_route('logout', 'Sign Out') }}</li>
        @endif
      </ul>
    </div>

    <div class="subfooter">
      &copy; 2014 DoSomething.org.
    </div>
    </footer>
  </div>
  </div>

  <script src="/dist/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
