<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

<style>
    @if(background('regular'))
    html { background-image: url('{{ background('regular') }}'); }
    @media (min-width: 1200px) {
        html { background-image: url('{{ background('retina') }}'); }
    }
    @endif

    @if(setting('ui_tint'))
    h1.highlighted, h2.highlighted, h3.highlighted { background-color: {{ setting('ui_tint') }} !important; }

    a, a:hover, a:active { color: {{ setting('ui_tint') }}; }
    .button.-primary, .button.-primary:hover, .button.-primary:active {
        color: #000 !important;
        background-color: {{ setting('ui_tint') }} !important;
    }
    .button.-secondary, .button.-secondary:hover, .button.-secondary:active {
        color: {{ setting('ui_tint') }} !important;
        background-color: transparent !important;
    }
    .button.-round, .button.-round:hover, .button.-round:active { background-color: {{ setting('ui_tint') }} !important; }

    .messages { color: {{ setting('ui_tint') }} !important; }

    input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus,
    input[type="search"]:focus, input[type="tel"]:focus, input[type="text"]:focus,
    input[type="url"]:focus, input[type="color"]:focus, input[type="date"]:focus,
    input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="month"]:focus,
    input[type="time"]:focus, input[type="week"]:focus, textarea:focus {
        border-color: {{ setting('ui_tint') }} !important;
    }
    @endif

    @if(!setting('vote_button'))
    .tile__action { display: none !important; }
    @endif

    @if(!setting('show_title'))
    .tile__meta { display: none !important; }
    @endif

    @if(!setting('search_bar'))
    .search-form { display: none !important; }
    @endif
</style>
