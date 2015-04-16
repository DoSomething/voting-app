@extends('app')

@section('content')
    <div class="wrapper">
        {{ Form::open(['route'=> ['sessions.store'], 'id' => 'sign_in_form']) }}
        @include('sessions.form')
        {{ Form::submit('Log In') }}
        {{ Form::close() }}
    </div>
@stop
