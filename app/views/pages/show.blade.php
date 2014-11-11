@extends('layout')

@section('content')
  <h3>{{{ $page->title }}}</h3>

  {{ $page->content_html }}
@stop

@section('actions')
  <li>{{ link_to_route('pages.edit', 'Edit Page', [$page->slug], ['class' => 'btn secondary']) }}</li>
@stop
