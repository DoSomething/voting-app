@extends('layout')

@section('content')
  <h3>All Candidates</h3>
  <ul class="gallery -mosaic">
  @forelse($candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate])
  @empty
    <li>No candidates.</li>
  @endforelse
  </ul>

    <h4>Actions</h4>
    <p>{{ link_to_route('candidates.create', 'New Candidate') }}</p>

@stop
