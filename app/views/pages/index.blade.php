@extends('layout')

@section('content')
  <h3>All Pages</h3>
  <ul>
  @forelse($pages as $page)
    <li>{{ link_to_route('pages.show', $page->title, $page->slug) }}
  @empty
    <li>No pages.</li>
  @endforelse
  </ul>

  <h4>Actions</h4>
  <p>{{ link_to_route('pages.create', 'New Page') }}</p>

@stop
