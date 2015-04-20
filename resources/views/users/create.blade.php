@extends('app')

@section('content')
    <h3>Create New Account</h3>

    {!! Form::open(['route'=> ['users.store']]) !!}
    @include('users.form')
    {!! Form::submit('Create New Account', ['class' => 'btn']) !!}
    {!! Form::close() !!}

    <p>{!! link_to_route('candidates.index', 'Go Back') !!}</p>

@stop
