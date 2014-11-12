@extends('layout')

@section('content')
  <h1>{{{ $page->title }}}</h1>

  {{ $page->content_html }}
@stop

@section('actions')
  <li>{{ link_to_route('pages.edit', 'Edit Page', [$page->slug], ['class' => 'btn secondary']) }}</li>
@stop
