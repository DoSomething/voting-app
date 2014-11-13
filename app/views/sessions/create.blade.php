@extends('layout')

@section('content')
  <h3>Sign In</h3>

  {{ Form::open(['route'=> ['sessions.store'], 'id' => 'sign_in_form']) }}
    {{ Form::label('first_name', 'First Name') }}
    {{ form_error('first_name', $errors) }}
    {{ Form::text('first_name') }}

    {{--@TODO email or phone number depending on country code--}}
    {{ Form::label('email', 'Email') }}
    {{ form_error('email', $errors) }}
    {{ Form::text('email') }}

    {{ Form::label('birthdate', 'Birthdate') }}
    {{ form_error('birthdate', $errors) }}
    {{ Form::text('birthdate',  null, ['placeholder' => 'MM/DD/YYYY']) }}

    {{ Form::submit('Sign In', ['class' => 'btn']) }}
  {{ Form::close() }}

@stop
