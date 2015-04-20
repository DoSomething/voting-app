<ul class="social-links">
  <li><a class="social-icon -facebook js-share-link"
         href="{{ facebook_intent((isset($candidate) ? route('candidates.show', [$candidate->slug]) : 'CANDIDATE_LINK')) }}"><span>Facebook</span></a>
  </li>
  <li><a class="social-icon -twitter js-share-link"
         href="{{ tweet_intent($settings['twitter_language'], (isset($candidate) ? route('candidates.show', [$candidate->slug]) : 'CANDIDATE_LINK'), (isset($candidate) ? $candidate->share_name : null)) }}"><span>Twitter</span></a>
  </li>
</ul>
