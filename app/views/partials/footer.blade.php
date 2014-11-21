<footer class="primary">
  {{ $settings['site_title'] }} is a program of <a href="https://www.dosomething.org">DoSomething.org</a>.

  <ul class="footer__links">
    <li><a class="social-icon -facebook js-share-link" href="{{ facebook_intent(url('/')) }}"><span>Facebook</span></a></li>
    <li><a class="social-icon -twitter js-share-link" href="{{ tweet_intent('Vote for your favorite celeb who has done kick ass things in the world in ' . $settings['site_title' ]. '.', url('/')) }}"><span>Twitter</span></a></li>
    <li><a  href="{{ $settings['faq_link_url'] }}">{{ $settings['faq_link_text'] }}</a></li>
  </ul>
</footer>
