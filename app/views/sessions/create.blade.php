@extends('layout')

@section('content')
  <h3>Sign In</h3>

  {{ Form::open(['route'=> ['sessions.store'], 'id' => 'sign_in_form']) }}
    {{ Form::label('first_name', 'First Name') }}
    {{ Form::error('first_name', $errors) }}
    {{ Form::text('first_name') }}

    {{--@TODO email or phone number depending on country code--}}
    {{ Form::label('email', 'Email') }}
    {{ form_error('email', $errors) }}
    {{ Form::text('email') }}

    {{ Form::label('birthdate', 'Birthdate') }}
    {{ Form::error('birthdate', $errors) }}
    {{ Form::text('birthdate') }}

    {{-- @TODO: password login for admins
    {{ Form::label('password', 'Password') }}
    {{ form_error('password', $errors) }}
    {{ Form::password('password') }}
    --}}

    {{ Form::submit('Sign In', ['class' => 'btn']) }}
  {{ Form::close() }}

@stop
