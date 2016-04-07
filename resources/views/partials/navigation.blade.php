<nav class="primary">
    <a class="navigation__logo" href="{{ route('home') }}">
        <img src="{{ asset(setting('logo_svg')) }}"
             onerror="this.onerror=null; this.src='{{ asset(setting('logo_png')) }}'"
             alt="{{ setting('site_title') }}">
    </a>

    @if(setting('sponsor_logo'))
        <figure class="figure -left -center">
            <div class="wrapper">
                <div class="figure__body">
                    <b>POWERED BY</b>
                </div>
                <div class="figure__media">
                    <img src="{{ asset(setting('sponsor_logo')) }}">
                </div>
            </div>
        </figure>
    @endif

    @if(session('message'))
        <div id="message"
             class="messages {{ session('message_type', '') }}">{{ session('message') }}</div>
    @else
        <div class="navigation__tagline">{!! setting('tagline') !!}</div>
    @endif
</nav>
