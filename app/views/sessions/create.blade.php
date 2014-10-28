@extends('layout')

@section('content')
  <h3>Sign In</h3>

  {{ Form::open(['route'=> ['sessions.store']]) }}
    {{ Form::label('email', 'Email') }}
    {{ Form::error('email', $errors) }}
    {{ Form::text('email') }}

    {{ Form::label('password', 'Password') }}
    {{ Form::error('password', $errors) }}
    {{ Form::password('password') }}

    {{ Form::submit('Sign In', ['class' => 'btn']) }}
  {{ Form::close() }}

@stop
