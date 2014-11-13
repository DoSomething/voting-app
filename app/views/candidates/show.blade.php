@extends('layout')

@section('title', $candidate->name)

@section('content')
<div class="candidate">
  <div class="candidate__info">
    <article class="tile -alternate">
      <a class="wrapper" href="{{{ route('candidates.show', [$candidate->slug]) }}}">
        <div class="tile__meta">
          <h1 class="__title">{{{ $candidate->name }}}</h1>
        </div>
        <img alt="{{{ $candidate->name }}}" src="{{{ $candidate->present()->thumbnail }}}" src="" />
      </a>
    </article>

    <p>{{{ $candidate->description }}}</p>
  </div>

  <div class="candidate__actions">
    @if(Auth::user())
      @if (Auth::user()->canVote($candidate))
        <p class="messages -inline">Welcome back, {{ Auth::user()->first_name }}! Ready to vote again?</p>
        {{ Form::open(['route' => 'votes.store']) }}
        {{ Form::hidden('candidate_id', $candidate->id) }}
        {{ Form::submit('Count My Vote', ['class' => 'button -primary']) }}
        {{ Form::close() }}
      @else
        <p class="messages -inline">You've already voted in this category today! Check back tomorrow!</p>
      @endif
    @else
      <p class="messages -inline">{{ link_to_route('login', 'Sign in') }} to vote!</p>
    @endif

    @if(Auth::user() && Auth::user()->hasRole('admin') && $votes)
    <h4>Hey, beautiful administrator. This candidate has {{{$vote_count }}} {{{ str_plural('vote', $vote_count)}}}.</h4>
    <ul>
    @forelse ($votes as $vote)
      <li>{{ link_to_route('users.show', $vote->user->email, $vote->user->id) }}</li>
    @empty
      <li>No votes! :(</li>
    @endforelse
    </ul>
    @endif
  </div>
</div>
@stop

@section('actions')
  @if(Auth::user() && Auth::user()->hasRole('admin'))
    <li>{{ link_to_route('candidates.edit', 'Edit Candidate', [$candidate->slug], ['class' => 'btn secondary']) }}</li>
  @endif
@stop
