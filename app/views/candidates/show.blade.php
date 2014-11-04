@extends('layout')

@section('content')
  <h3>{{{ $candidate->name }}}</h3>

  @if($candidate->description)
  <h4>About this Candidate</h4>
  <p>{{{ $candidate->description }}}</p>
  @endif

  @if(Auth::user() && Auth::user()->hasRole('admin') && $votes)
  <h4>{{{$vote_count }}} {{{ str_plural('vote', $vote_count)}}}</h4>
  <ul>
  @forelse ($votes as $vote)
    <li>{{ link_to_route('users.show', $vote->user->email, $vote->user->id) }}</li>
  @empty
    <li>No votes! :(</li>
  @endforelse
  </ul>
  @endif

  <h4>Your Vote</h4>
  @if(Auth::user())
    @if (Auth::user()->canVote($candidate))
      {{ Form::open(['route' => 'votes.store']) }}
      {{ Form::hidden('candidate_id', $candidate->id) }}
      {{ Form::submit('Vote', ['class' => 'btn']) }}
      {{ Form::close() }}
    @else
      You've already voted today!
    @endif
  @else
    {{ link_to_route('login', 'Sign in') }} to vote!
  @endif


  @if($candidate->photo)
  <h4>Photo</h4>
  <a href="/images/{{{ $candidate->photo }}}"><img src="/images/thumb-{{{ $candidate->photo }}}" alt="{{{ $candidate->name }}}" width="200" height="200"></a>
  @endif

  @if($candidate->category)
  <h4>Category</h4>
  <p>{{ link_to_route('categories.show', $candidate->category->name, [$candidate->category->slug]) }}</p>
  @endif

  <h4>Actions</h4>
  @if(Auth::user() && Auth::user()->hasRole('admin'))
    <p>{{ link_to_route('candidates.edit', 'Edit Candidate', [$candidate->slug], ['class' => 'btn secondary']) }}</p>
  @endif
  <p>{{ link_to_route('candidates.index', 'Go Back') }}</p>

@stop
