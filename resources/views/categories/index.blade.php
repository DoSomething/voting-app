@extends('app')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">All Categories</h1>

      <p>These are all categories in the database. Categories will automatically show up in the site navigation
        above.</p>
    </div>
    <ul>
      @forelse($categories as $category)
        <li><a href="{{ route('categories.show', [$category->slug]) }}">{{ $category->name }}</a></li>
      @empty
        <li>No categories.</li>
      @endforelse
    </ul>
  </div>
@stop

@section('actions')
  <li><a href="{{ route('categories.create') }}">New Category</a></li>
@stop
