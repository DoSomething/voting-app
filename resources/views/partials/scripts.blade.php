<script type="text/javascript" charset="utf-8">
    function loadScript(src) {
        var async = arguments[1] === undefined ? true : arguments[1];
        var ref = window.document.getElementsByTagName('script')[0];
        var script = window.document.createElement('script');
        script.src = src;
        if(async) script.async = async;
        ref.parentNode.insertBefore(script, ref);
    }

    var supportsMQ = window.matchMedia && window.matchMedia( "only all" ) !== null && window.matchMedia( "only all" ).matches;
    if (!supportsMQ) {
        loadScript('{{ asset('assets/vendor/respond.min.js') }}', false)
    }

    if ('querySelector' in document && 'addEventListener' in window) {
        loadScript('{{ asset('js/app.js') }}');
    }
</script>

<!--[if lte IE 8]>
    <script type="text/javascript" charset="utf-8" src="{{ asset('assets/vendor/html5shiv.min.js') }}"></script>
<![endif]-->
