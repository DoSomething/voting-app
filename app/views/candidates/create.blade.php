@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">New Candidate</h1>
    </div>

    {{ Form::open(['route'=> ['candidates.store'], 'files' => true]) }}
    @include('candidates.form')
    {{ Form::submit('Create Candidate') }}
    {{ Form::close() }}

  </div>
@stop
