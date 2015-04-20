@extends('app')

@section('content')
    <div class="wrapper">
        <h1 class="highlighted">Login</h1>
        {!! Form::open(['route'=> ['sessions.userLogin'], 'id' => 'sign_in_form']) !!}
        @include('sessions.form')
        {!! Form::submit('Log In') !!}
        {!! Form::close() !!}
    </div>
@stop
