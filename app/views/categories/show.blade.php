@extends('layout')

@section('title', $category->name)

@section('content')
  <ul class="gallery">
  @forelse($category->candidates as $candidate)
    @include('candidates.tile', ['candidate' => $candidate, 'drawer' => true])
  @empty
    <li class="empty">No candidates in this category... yet!</li>
  @endforelse
  </ul>

  <script type="text/html" id="form-template">
    @include('candidates.voteForm', ['category' => $category])
  </script>

@stop

@section('actions')
  <li>{{ link_to_route('categories.edit', 'Edit Category', [$category->slug], ['class' => 'btn secondary']) }}</li>
@stop

