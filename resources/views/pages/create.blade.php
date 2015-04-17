@extends('app')

@section('content')
  <h3>New Candidate</h3>

  {!! Form::open(['route'=> ['pages.store']]) !!}
  @include('pages.form')
  {!! Form::submit('Create Page', ['class' => 'btn']) !!}
  {!! Form::close() !!}

  <p>{{ link_to_route('pages.index', 'Go Back') }}</p>
@stop
