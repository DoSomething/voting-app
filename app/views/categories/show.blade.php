@extends('layout')

@section('title', $category->name)

@section('content')
  <ul class="gallery">
  @if($category->candidates)
    @foreach($category->candidates as $candidate)
      @include('candidates.tile', ['candidate' => $candidate, 'drawer' => true])
    @endforeach
  @else
    <li class="empty">No candidates in this category... yet!</li>
  @endif
  </ul>

  <script type="text/html" id="form-template">
    @include('candidates.voteForm', ['category' => $category, 'candidate' => null])
  </script>

@stop

@section('actions')
  <li>{{ link_to_route('categories.edit', 'Edit Category', [$category->slug], ['class' => 'btn secondary']) }}</li>
@stop

