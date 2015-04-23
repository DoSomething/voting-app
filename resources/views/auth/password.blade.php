{{-- Password Reset --}}

@extends('app')

@section('content')
    <div class="wrapper">
        <h1>Reset Password</h1>
        <p>Set a new password for your account.</p>

        @include('partials.errors')

        {!! Form::open() !!}
            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['placeholder' => 'you@dosomething.org']) !!}

            {!! Form::submit('Reset My Password') !!}
        {!! Form::close() !!}
    </div>
@stop
