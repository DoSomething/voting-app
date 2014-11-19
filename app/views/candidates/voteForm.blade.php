@if(Auth::user())
  @if (Auth::user()->canVoteInCategory($category))
    <p class="messages -inline">Welcome back, {{ Auth::user()->first_name }}! Ready to vote again?</p>
    {{ Form::open(['route' => 'votes.store']) }}
    {{ Form::hidden('candidate_id', (isset($id) ? $id : null)) }}
    {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
    {{ Form::close() }}
  @else
    <p class="messages -inline">You've already voted in this category today! Check back tomorrow!</p>
  @endif
@else
  {{--@TODO: switch to user_phone condiationally --}}
  @include('sessions/partials/_' . $type)
@endif
