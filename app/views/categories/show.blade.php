@extends('layout')

@section('title', $category->name)

@section('content')

  @if( Auth::user() && !Auth::user()->canVoteInCategory($category))
  <div class="messages">You can't vote again in this category yet.</div>
  @endif

  <ul class="gallery">
  @forelse($category->candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate])
  @empty
  <li>No candidates</li>
  @endforelse
  </ul>
@stop

  @if(Auth::user() && Auth::user()->hasRole('admin'))
    <h4>Actions</h4>
    <p>{{ link_to_route('categories.edit', 'Edit Category', [$category->slug], ['class' => 'btn secondary']) }}</p>
  @endif

@stop
