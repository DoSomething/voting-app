@extends('app')

@section('content')
    <div class="wrapper">
        <h1 class="highlighted">Administrator Sign In</h1>
        <p>With great power, comes great responsibility...</p>

        @include('partials.errors')

        {!! Form::open(['url'=> 'admin', 'id' => 'sign_in_form']) !!}
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['placeholder' => 'you@dosomething.org']) !!}

            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password') !!}

            {!! Form::submit('Sign In', ['class' => 'btn']) !!}
        {!! Form::close() !!}

        <div class="form-actions">
            <a href="{{ url('/password/email') }}">Forgot password</a>
        </div>
    </div>
@stop
