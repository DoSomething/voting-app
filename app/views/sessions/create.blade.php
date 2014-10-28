@extends('layout')

@section('content')
  <h3>Sign In</h3>

  {{ Form::open(['route'=> ['sessions.store']]) }}
    {{ Form::label('email', 'Email') }}
    {{ $errors->first('email', '<span class="validation error">:message</span>') }}
    {{ Form::text('email') }}

    {{ Form::label('password', 'Password') }}
    {{ $errors->first('password', '<span class="validation error">:message</span>') }}
    {{ Form::password('password') }}

    {{ Form::submit('Sign In', ['class' => 'btn']) }}
  {{ Form::close() }}

@stop
