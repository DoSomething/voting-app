@extends('layout')

@section('content')
  <h3>{{{ $category->name }}}</h3>

  <h4>Candidates</h4>
  <ul class="gallery -mosaic">
  @forelse($category->candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate])
  @empty
  <li>No candidates</li>
  @endforelse
  </ul>

  <h4>Actions</h4>
  <p>{{ link_to_route('categories.edit', 'Edit Category', [$category->slug], ['class' => 'btn secondary']) }}</p>
  <p>{{ link_to_route('categories.index', 'Go Back') }}</p>

@stop
