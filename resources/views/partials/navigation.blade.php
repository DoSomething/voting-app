<nav class="primary">
    <a class="navigation__logo" href="{{ route('home') }}">
        <img src="{{ asset('assets/images/logo.default.svg') }}"
             onerror="this.onerror=null; this.src='{{ asset('assets/images/logo.default.png') }}'"
             alt="{{ $settings['site_title'] }}">
    </a>

    @if(Session::has('message'))
        <div id="message"
             class="messages {{ Session::get('message_type', '') }}">{{ Session::get('message') }}</div>
    @else
        <p class="navigation__tagline">{{ $settings['tagline'] }}</p>
    @endif
</nav>
