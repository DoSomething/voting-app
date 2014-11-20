@if(Auth::user())
  @if (Auth::user()->canVoteInCategory($category))
    <p class="heading -hero">Welcome back, {{ Auth::user()->first_name }}! Ready to vote again?</p>
    {{ Form::open(['route' => 'votes.store']) }}
    {{ Form::hidden('candidate_id', (isset($id) ? $id : null)) }}
    {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
    {{ Form::close() }}
  @else
    <p class="heading -alpha">Thanks for voting! You can vote again in 24 hours.</p>
    @if($candidate)
      <p class="heading -gamma">Get {{ $candidate->name }} more votes!</p>
      <ul class="social-links">
        <li><a class="social-icon -facebook js-share-link" href="{{ facebook_intent('I voted!', 'http://bit.ly/1zDXHTV') }}"><span>Facebook</span></a></li>
        <li><a class="social-icon -twitter js-share-link" href="{{ tweet_intent('I voted for ' . $candidate->twitter . ' in #celebsgonegood who rocked this year! Vote for your fave celeb NOW:', 'http://bit.ly/1zDXHTV') }}"><span>Twitter</span></a></li>
      </ul>
    @else
      <p class="heading -gamma">Get @{{ name }} more votes!</p>
      <ul class="social-links">
        <li><a class="social-icon -facebook js-share-link" href="{{ facebook_intent('I voted!', 'http://bit.ly/1zDXHTV') }}"><span>Facebook</span></a></li>
        <li><a class="social-icon -twitter js-share-link" href="{{ tweet_intent('I voted for TWITTER_NAME in #celebsgonegood who rocked this year! Vote for your fave celeb NOW:', 'http://bit.ly/1zDXHTV') }}"><span>Twitter</span></a></li>
      </ul>
    @endif
  @endif
@else
  @include('sessions/partials/_' . $type)
@endif

