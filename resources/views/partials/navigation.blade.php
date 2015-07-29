<nav class="primary">
    <a class="navigation__logo" href="{{ route('home') }}">
        <img src="{{ asset(setting('logo_svg')) }}"
             onerror="this.onerror=null; this.src='{{ asset(setting('logo_png')) }}'"
             alt="{{ setting('site_title') }}">
    </a>

    @if(Session::has('message'))
        <div id="message"
             class="messages {{ Session::get('message_type', '') }}">{{ Session::get('message') }}</div>
    @else
        <div class="navigation__tagline">{!! setting('tagline') !!}</div>
    @endif
</nav>
