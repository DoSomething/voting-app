@extends('app')

@section('content')
    <div class="wrapper">
        <h1>{{{ $page->title }}}</h1>

        {!! $page->content_html !!}
    </div>
@stop

@section('actions')
    <li><a href="{{ route('pages.edit', [$page->slug]) }}">Edit Page</a></li>
@stop
