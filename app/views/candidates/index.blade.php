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
@stop

@section('actions')
  <li>{{ link_to_route('candidates.create', 'New Candidate') }}</li>
@stop
