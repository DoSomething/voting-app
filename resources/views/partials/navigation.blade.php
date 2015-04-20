<nav class="primary">
    <a class="navigation__logo" href="{{{ route('home') }}}"><img src="/assets/images/logo.png"
                                                                  alt="Celebs Gone Good"></a>

    @if(Session::has('flash_message'))
        <div id="message"
             class="messages {{ Session::get('flash_message_type', '') }}">{{ Session::get('flash_message') }}</div>
    @else
        <p class="navigation__tagline">{{ $settings['tagline'] }}</p>
    @endif
</nav>
