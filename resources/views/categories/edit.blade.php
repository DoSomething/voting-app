@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Edit Category: {{{ $category->name }}}</h1>

            <p>Changing the name of category will not change its URL.</p>
        </div>

        @include('partials.errors')

        {!! Form::model($category, ['route'=> ['categories.update', $category->slug]]) !!}
            @include('categories.form')
            {!! Form::submit('Update Category') !!}
        {!! Form::close() !!}

    </div>
@stop
