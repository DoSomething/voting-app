@extends('app')

@section('content')
<div class="wrapper">
    <h3>New Category</h3>

    @include('partials.errors')

    {!! Form::open(['route' => 'categories.store']) !!}
        @include('categories.form')
        {!! Form::submit('Create Category') !!}
    {!! Form::close() !!}
</div>
@stop
