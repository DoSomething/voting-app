@extends('layout')

@section('content')
  <h3>All Candidates</h3>
  <ul>
  @forelse($candidates as $candidate)
    <li>{{ link_to_route('candidates.show', $candidate->name, [$candidate->slug]) }}</li>
  @empty
    <li>No candidates.</li>
  </ul>
  @endforelse

    <h4>Actions</h4>
    <p>{{ link_to_route('candidates.create', 'New Candidate') }}</p>

@stop
