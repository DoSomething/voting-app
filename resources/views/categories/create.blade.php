@extends('app')

@section('content')
<div class="wrapper">
    <h3>New Category</h3>

    @include('partials.errors')

    <form method="POST" action="{{ route('categories.store') }}">
    {!! Form::open(['route' => 'categories.store']) !!}
        @include('categories.form')
        {!! Form::submit('Create Category') !!}
    {!! Form::close() !!}

    <p><a href="{{ route('categories.index') }}">Go Back</a></p>
</div>
@stop
