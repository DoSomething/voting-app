@extends('layout')

@section('content')
  <h3>All Categories</h3>
  <ul>
  @forelse($categories as $category)
    <li>{{ link_to_route('categories.show', $category->name, [$category->slug]) }}</li>
  @empty
    <li>No categories.</li>
  @endforelse
  </ul>

  <h4>Actions</h4>
  <p>{{ link_to_route('categories.create', 'New Category') }}</p>

@stop
