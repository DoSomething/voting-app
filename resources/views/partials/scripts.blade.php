<script type="text/javascript" charset="utf-8">
    function loadScript(src) {
        var ref = window.document.getElementsByTagName('script')[0];
        var script = window.document.createElement('script');
        script.src = src; script.async = true;
        ref.parentNode.insertBefore(script, ref);
    }

    if ('querySelector' in document && 'addEventListener' in window) {
        loadScript('{{ asset('/js/bundle.js') }}');
    }
</script>
