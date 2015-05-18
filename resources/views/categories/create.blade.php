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
</div>
@stop
