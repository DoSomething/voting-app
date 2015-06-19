{{-- General social metadata --}}
<link rel="canonical" href="{{ URL::current() }}"/>
<meta name="description"
      content="@yield('meta_description', 'Vote for your favorite ' . setting('candidate_type') . ' who has done kickass things in the world this year.')"/>

{{-- Twitter --}}
<meta name="twitter:site" content="@dosomething"/>
<meta name="twitter:creator" content="@dosomething"/>
<meta name="twitter:url" content="{{ URL::current() }}"/>
<meta name="twitter:title" content="@yield('meta_title', setting('site_title'))"/>
<meta name="twitter:description"
      content="@yield('meta_description', 'Vote for your favorite ' . setting('candidate_type')  . ' who has done kickass things in the world.')"/>
<meta name="twitter:image" content="@yield('meta_image', asset(setting('twitter_share', 'assets/images/twitter_share.default.jpg')))"/>

{{-- Facebook --}}
<meta property="og:site_name" content="{{ setting('site_title') }}"/>
<meta property="og:title" content="@yield('meta_title', setting('site_title'))"/>
<meta property="og:image" content="@yield('meta_image', asset(setting('facebook_share', 'assets/images/facebook_share.default.jpg')))"/>
