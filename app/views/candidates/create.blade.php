@extends('layout')

@section('content')
  <h3>New Candidate</h3>

  {{ Form::open(['route'=> ['candidates.store'], 'files' => true]) }}
  @include('candidates.form')
  {{ Form::submit('Create Candidate', ['class' => 'btn']) }}
  {{ Form::close() }}

  <p>{{ link_to_route('candidates.index', 'Go Back') }}</p>

@stop
