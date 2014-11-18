@extends('layout')

@section('content')
  <div class="row">
    <h1 class="highlighted">All Candidates</h1>
    <p>These are all candidates in the database. (Only visible for administrators.)</p>
  </div>
  <ul class="gallery -mosaic">
  @forelse($candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate])
  @empty
    <li class="empty">No candidates... yet!</li>
  @endforelse
  </ul>
@stop

@section('actions')
  <li>{{ link_to_route('candidates.create', 'New Candidate') }}</li>
@stop
