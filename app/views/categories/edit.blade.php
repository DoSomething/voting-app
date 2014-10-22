@extends('layout')

@section('content')
  <h3>{{{ $category->name }}}</h3>

  {{ Form::model($category, ['route'=> ['categories.update', $category->slug], 'method' => 'PATCH']) }}
    @include('categories.form')

    {{ Form::submit('Update Category', ['class' => 'btn']) }}
  {{ Form::close() }}

  <p>{{ link_to_route('categories.index', 'Go Back') }}</p>

@stop
