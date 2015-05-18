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
            {!! Form::model($page, ['method' => 'PUT', 'route' => ['pages.update', $page->slug], 'method' => 'PATCH']) !!}
                @include('pages.form')
                {!! Form::submit('Update Page') !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="wrapper">
        <p>If this page is no longer wanted, you may delete it.</p>
        <div class="form-actions">
            <a href="{{ route('pages.destroy', [$page->slug]) }}" data-method="DELETE" data-confirm="Are you sure you want to delete this page?" class="button -danger">Delete Page</a>
        </div>
    </div>
@stop
