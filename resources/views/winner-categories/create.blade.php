@extends('app')

@section('content')
<div class="wrapper">
    <div class="row">
        <h1 class="highlighted">New Winner Category</h1>
    </div>

    <div class="row">
        @include('partials.errors')

        {!! Form::open(['route' => 'winner-categories.store']) !!}
            @include('categories.form')
            {!! Form::submit('Create Winner Category') !!}
        {!! Form::close() !!}
    </div>
</div>
@stop
