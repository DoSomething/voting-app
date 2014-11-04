@extends('layout')

@section('content')
  <h3>{{{ $user->email }}}</h3>

  @if($votes)
  <h4>{{{$vote_count }}} {{{ str_plural('vote', $vote_count)}}}</h4>
  <ul>
  @forelse ($votes as $vote)
    <li>{{ link_to_route('candidates.show', $vote->candidate->name, $vote->candidate->slug) }}</li>
  @empty
    <li>No votes! :(</li>
  @endforelse
  </ul>
  @endif

@stop
