{{-- Password Reset --}}

@extends('app')

@section('content')
    <article class="page">
        <h1>Reset Password</h1>

        <p>Set a new password for your account.</p>

        {{ Form::open() }}

        {{ Form::hidden('token', $token) }}

        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, ['placeholder' => 'you@dosomething.org']) }}

        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}

        {{ Form::label('password_confirmation', 'Password Confirm') }}
        {{ Form::password('password_confirmation') }}

        {{-- Submit Button --}}
        <div class="field-group">
            {{ Form::submit('Submit', ['class' => 'button -default']) }}
        </div>

        {{ Form::close() }}

    </article>
@stop
