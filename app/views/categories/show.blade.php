@extends('layout')

@section('title', $category->name)

@section('content')

  @if( Auth::user() && !Auth::user()->canVoteInCategory($category))
  <div class="messages">You can't vote again in this category yet. Come back tomorrow!</div>
  @endif

  <ul class="gallery">
  @forelse($category->candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate])
  @empty
  <li>No candidates</li>
  @endforelse
  </ul>

  <script type="text/html" id="form-template">
    Hello, <strong>HTML</strong> world!
  </script>

@stop

@section('actions')
  <li>{{ link_to_route('categories.edit', 'Edit Category', [$category->slug], ['class' => 'btn secondary']) }}</li>
@stop

