<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Celebs Gone Laravel</title>

	<link rel="stylesheet" href="/dist/app.css" type="text/css" media="screen" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
</head>
<body>
  <div class="chrome">
  <div class="chrome--wrapper">
		<nav class="chrome--nav">
			<a class="logo" href="http://www.dosomething.org"><img src="/logo.png" alt="Celebs Gone Good"></a>
			<a class="hamburger js-toggle-mobile-menu" href="#">&#xe606;</a>
			<div class="menu">
				<ul class="primary-nav">
					<li>{{ link_to_route('candidates.index', 'Candidates') }}</li>
					<li>{{ link_to_route('categories.index', 'Categories') }}</li>
				</ul>
			</div>
		</nav>

    <div class="container">
      <div class="wrapper">
        @yield('content')
      </div>
    </div>
  </div>
  </div>

  <script src="/dist/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
