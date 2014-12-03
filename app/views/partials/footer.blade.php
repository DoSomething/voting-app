<footer class="primary">
  {{ $settings['site_title'] }} is a program of <a href="https://www.dosomething.org">DoSomething.org</a>.

  <ul class="footer__links">
    <li><a class="social-icon -facebook js-share-link" href="{{ facebook_intent(url('/')) }}"><span>Facebook</span></a></li>
    <li><a class="social-icon -twitter js-share-link" href="{{ tweet_intent('.@dosomething\'s #CelebsGoneGood is back, vote for your fav celeb doing kickass things in the world this year now: ', url('/')) }}"><span>Twitter</span></a></li>
  </ul>
</footer>
