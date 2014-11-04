@extends('layout')

@section('content')
  <h3>{{{ $page->title }}}</h3>

  {{ $page->content_html }}

  @if(Auth::user() && Auth::user()->hasRole('admin'))
    <h4>Actions</h4>
    <p>{{ link_to_route('pages.edit', 'Edit Page', [$page->slug], ['class' => 'btn secondary']) }}</p>
  @endif

@stop
