@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Create Page</h1>

            <p>Page content can be formatted using <a href="http://daringfireball.net/projects/markdown/syntax"
                                                      target="_blank">Markdown</a>.</p>
        </div>

        @include('partials.errors')

        {!! Form::open(['route' => 'pages.store']) !!}
            @include('pages.form')
            {!! Form::submit('Create Page') !!}
        {!! Form::close() !!}

        <p><a href="{{ route('pages.index') }}">Go Back</a></p>
    </div>
@stop
