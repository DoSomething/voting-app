{{-- General social metadata --}}
<link rel="canonical" href="{{{ URL::current() }}}" />
<meta name="description" content="@yield('meta_description', 'Vote for your favorite celebrity who has done kickass things in the world this year.')" />

{{-- Twitter --}}
<meta name="twitter:site" content="@dosomething" />
<meta name="twitter:creator" content="@dosomething" />
<meta name="twitter:url" content="{{{ URL::current() }}}" />
<meta name="twitter:title" content="@yield('meta_title', 'Celebs Gone Good')" />
<meta name="twitter:description" content="@yield('meta_description', 'Vote for your favorite celeb who has done kickass things in the world.')" />
<meta name="twitter:image" content="@yield('meta_image', URL::to('/dist/images/twitter-share.jpg'))"/>

{{-- Facebook --}}
<meta property="og:site_name" content="{{ $settings['site_title'] }}"/>
<meta property="og:title" content="@yield('meta_title', 'Celebs Gone Good')"/>
<meta property="og:image" content="@yield('meta_image', URL::to('/dist/images/fb-share.jpg'))"/>

