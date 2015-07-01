<footer class="primary">
    {{ setting('site_title') }} is a program of <a href="https://www.dosomething.org">DoSomething.org</a>.

    <ul class="footer__links">
        <li><a href="{{ setting('faq_link_url') }}">{{ setting('faq_link_text') }}</a></li>
        <li><a class="social-icon -facebook js-share-link" href="{{ facebook_intent(url('/')) }}"><span>Facebook</span></a>
        </li>
        <li><a class="social-icon -twitter js-share-link"
               href="{{ tweet_intent(setting('twitter_site_language'), url('/')) }}"><span>Twitter</span></a>
        </li>
    </ul>
</footer>
