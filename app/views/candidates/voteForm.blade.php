@if(Auth::user())
  @if (Auth::user()->canVoteInCategory($category))
    <p class="heading -hero">Hey, {{ Auth::user()->first_name }}! Ready to cast your vote for {{{ $category->name }}}?</p>
    {{ Form::open(['route' => 'votes.store']) }}
    {{ Form::hidden('candidate_id', (isset($id) ? $id : null)) }}
    {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
    {{ Form::close() }}
  @else
    <p class="heading -alpha">Thanks for voting! You can vote again in this category in 24 hours.</p>
    <p class="heading -gamma">Get {{ $candidate->name or "CANDIDATE_NAME" }} more votes!</p>
    @include('candidates.share');
  @endif
@else
    {{ Form::open(['route'=> ['sessions.store'], 'id' => 'sign_in_form']) }}
      @include('sessions.form', [$type])
      {{ Form::hidden('candidate_id', (isset($candidate->id) ? $candidate->id : null)) }}
      {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
      <p class="legal" id="ctia">By voting you agree to receive future updates from DoSomething.org. Message & data rates may apply. Text STOP to opt-out, HELP for help.</p>
    {{ Form::close() }}
@endif

