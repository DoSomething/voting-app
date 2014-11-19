@extends('layout')

@section('title', $candidate->name)
@section('meta_title', $candidate->name)
@section('meta_description', $candidate->description)
@section('meta_image', URL::to($candidate->present()->thumbnail))

@section('content')
<div class="candidate">
  <div class="candidate__info">
    <article class="tile -alternate">
      <a class="wrapper" href="{{{ route('candidates.show', [$candidate->slug]) }}}">
        <div class="tile__meta">
          <h1>{{{ $candidate->name }}}</h1>
        </div>
        <img alt="{{{ $candidate->name }}}" src="{{{ $candidate->present()->thumbnail }}}" src="" />
      </a>
    </article>

    @if($candidate->description)
      <p class="candidate__description">{{{ $candidate->description }}}</p>
    @endif
  </div>

  <div class="candidate__actions">
    @include('candidates.voteForm', ['category' => $candidate->category, 'id' => $candidate->id])

    @if(Auth::user() && Auth::user()->hasRole('admin') && $vote_count)
    <h4>Hey, beautiful administrator. This candidate has {{{$vote_count }}} {{{ str_plural('vote', $vote_count)}}}.</h4>
    @endif
  </div>
</div>
@stop

@section('actions')
  @if(Auth::user() && Auth::user()->hasRole('admin'))
    <li>{{ link_to_route('candidates.edit', 'Edit Candidate', [$candidate->slug], ['class' => 'btn secondary']) }}</li>
    {{ Form::open(['route'=> ['candidates.update', $candidate->slug], 'method' => 'delete']) }}
          {{ Form::submit('Delete Candidate', ['class' => 'button -danger']) }}
    {{ Form::close() }}
  @endif
@stop
