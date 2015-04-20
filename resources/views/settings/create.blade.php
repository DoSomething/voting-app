@extends('app')

@section('content')
    <h3>New Setting</h3>

    {!! Form::open(['route'=> ['settings.store']]) !!}
    @include('settings.form')

    {!! Form::submit('Create Setting', ['class' => 'btn']) !!}
    {!! Form::close() !!}

    <p>{{ link_to_route('settings.index', 'Go Back') }}</p>

@stop
