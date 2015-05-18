@extends('app')

@section('content')
    <div class="wrapper">
        <h1>{{{ $page->title }}}</h1>

        {!! $page->content_html !!}
    </div>
@stop
