@extends('layout')

@section('content')
  <h3>{{{ $candidate->name }}}</h3>

  {{ Form::model($candidate, ['route'=> ['candidates.update', $candidate->slug], 'files' => true, 'method' => 'PATCH']) }}
	@include('candidates.form')
	{{ Form::submit('Update Candidate', ['class' => 'btn']) }}
  {{ Form::close() }}

  <p>{{ link_to_route('candidates.index', 'Go Back') }}</p>

@stop
