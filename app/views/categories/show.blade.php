@extends('layout')

@section('content')
  <h3>{{{ $category->name }}}</h3>

  @if( Auth::user() && !Auth::user()->canVoteInCategory($category))
  <div class="messages">You can't vote again in this category yet.</div>
  @endif

  <h4>Candidates</h4>
  <ul class="gallery -mosaic">
  @forelse($category->candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate])
  @empty
  <li>No candidates</li>
  @endforelse
  </ul>

  @if(Auth::user() && Auth::user()->hasRole('admin'))
    <h4>Actions</h4>
    <p>{{ link_to_route('categories.edit', 'Edit Category', [$category->slug], ['class' => 'btn secondary']) }}</p>
  @endif

@stop
