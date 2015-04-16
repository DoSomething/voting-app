{{-- Password Reset --}}

@extends('app')

@section('content')
    <article class="page">
        <h1>Reset Password</h1>

        <p>Set a new password for your account.</p>

        {{ Form::open() }}

        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, ['placeholder' => 'you@dosomething.org']) }}

        {{-- Submit Button --}}
        {{ Form::submit('Submit', ['class' => 'button -default']) }}

        {{ Form::close() }}

    </article>
@stop
