@extends('layout')

@section('title', 'Write In Vote')
s
@section('content')
<div class="candidate">
  <div class="candidate__info">
      {{ Form::open(['route' => 'write-in.store']) }}
      {{ Form::hidden('write-in') }}
      {{ Form::text('candidate_name', NULL, ['placeholder' => 'Name']) }}
      {{ Form::textarea('description', NULL, ['placeholder' => 'Why?']) }}
      {{ Form::close() }}
  </div>

  <div class="candidate__actions">

    @if (!Auth::user())
      @include('sessions/partials/_user_email')
    @endif
  </div>
</div>
@stop


@stop
