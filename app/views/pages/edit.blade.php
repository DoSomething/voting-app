@extends('layout')

@section('content')
  <h3>{{{ $page->name }}}</h3>

  {{ Form::model($page, ['route'=> ['pages.update', $page->slug], 'method' => 'PATCH']) }}
  @include('pages.form')
  {{ Form::submit('Update Page', ['class' => 'btn']) }}
  {{ Form::close() }}

  <p>{{ link_to_route('pages.index', 'Go Back') }}</p>

@stop
