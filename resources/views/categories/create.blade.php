@extends('app')

@section('content')
    <h3>New Category</h3>

    {!! Form::open(['route'=> ['categories.store']]) !!}
    @include('categories.form')

    {!! Form::submit('Create Category', ['class' => 'btn']) !!}
    {!! Form::close() !!}

    <p><a href="{{ route('categories.index') }}">Go Back</a></p>
@stop
