@if(Auth::user())
  @if (Auth::user()->canVoteInCategory($category))
    <p class="heading -hero">Welcome back, {{ Auth::user()->first_name }}! Ready to vote again?</p>
    {{ Form::open(['route' => 'votes.store']) }}
    {{ Form::hidden('candidate_id', (isset($id) ? $id : null)) }}
    {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
    {{ Form::close() }}
  @else
    <p class="heading -alpha">Thanks for voting! You can vote again in 24 hours.</p>
  @endif
@else
  @include('sessions/partials/_' . $type)
@endif
