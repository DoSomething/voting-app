<nav class="primary">
    <a class="navigation__logo" href="{{ route('home') }}"><img src="/assets/images/logo.png"
                                                                  alt="Celebs Gone Good"></a>

    @if(Session::has('message'))
        <div id="message"
             class="messages {{ Session::get('message_type', '') }}">{{ Session::get('message') }}</div>
    @else
        <p class="navigation__tagline">{{ $settings['tagline'] }}</p>
    @endif
</nav>
