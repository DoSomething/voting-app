@extends('layout')

@section('title', 'Write In Vote')
s
@section('content')
<div class="candidate">
  <div class="candidate__info">
    @if (Auth::user())
      {{ Form::open(['route' => 'write-in.store']) }}
      {{ Form::text('candidate_name', NULL, ['placeholder' => 'Name']) }}
      {{ Form::textarea('description', NULL, ['placeholder' => 'Why?']) }}
      {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
      {{ Form::close() }}
    @else
      <p class="messages -inline"> Log in to write in your vote! </p>
    @endif
  </div>

  <div class="candidate__actions">
    @if (!Auth::user())
      @include('sessions/partials/_user_email')
    @endif
  </div>
</div>
@stop


@stop
