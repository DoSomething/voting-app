<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Voting [4.2]</title>

	<link rel="stylesheet" href="/dist/app.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
  <div class="chrome">
  <div class="chrome--wrapper">
    <div class="container">
      <div class="wrapper">
        <h1>Celebs Gone Laravel</h1>
				<nav class="tabs">
				<ul>
				<li>{{ link_to_route('candidates.index', 'Candidates') }}</li>
				<li>{{ link_to_route('categories.index', 'Categories') }}</li>
				</ul>

				</nav>
        @yield('content')
      </div>
    </div>
  </div>
  </div>

  <script src="/dist/app.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
