@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Edit Page: {{ $page->title }}</h1>

            <p>Page content can be formatted using <a href="http://daringfireball.net/projects/markdown/syntax"
                                                      target="_blank">Markdown</a>.</p>
        </div>

        @include('partials.errors')

        <div class="row">
            {!! Form::model($page, ['route' => ['pages.update', $page->slug], 'method' => 'PATCH']) !!}
                @include('pages.form')
                {!! Form::submit('Create Page') !!}
            {!! Form::close() !!}
        </div>

    </div>
@stop
