@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Edit Category: {{{ $category->name }}}</h1>

            <p>Changing the name of category will not change its URL.</p>
        </div>

        @include('partials.errors')

        {!! Form::model($category, ['method' => 'PUT', 'route'=> ['categories.update', $category->slug]]) !!}
            @include('categories.form')
            {!! Form::submit('Update Category') !!}
        {!! Form::close() !!}
    </div>

    <div class="wrapper">
        <p>If this category is no longer wanted, you may delete it. All candidates within this category must be deleted or moved into another category first.</p>
        <div class="form-actions">
            <a href="{{ route('categories.destroy', [$category->slug]) }}" data-method="DELETE" data-confirm="Are you sure you want to delete this category?" class="button -danger">Delete Category</a>
        </div>
    </div>
@stop
