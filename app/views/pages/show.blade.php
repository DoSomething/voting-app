@extends('layout')

@section('content')
  <div class="wrapper">
    <h1 class="highlighted">{{{ $page->title }}}</h1>

    {{ $page->content_html }}
  </div>
@stop

@section('actions')
  <li>{{ link_to_route('pages.edit', 'Edit Page', [$page->slug], ['class' => 'btn secondary']) }}</li>
@stop
