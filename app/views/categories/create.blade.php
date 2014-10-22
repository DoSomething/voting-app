@extends('layout')

@section('content')
  <h3>New Category</h3>

  {{ Form::open(['route'=> ['categories.store']]) }}
    @include('categories.form')

    {{ Form::submit('Create Category', ['class' => 'btn']) }}
  {{ Form::close() }}

  <p>{{ link_to_route('categories.index', 'Go Back') }}</p>

@stop
