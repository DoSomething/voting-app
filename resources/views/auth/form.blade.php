@include('partials.errors')

{!! Form::label('first_name', 'First Name') !!}
{!! Form::text('first_name', null, ['placeholder' => 'What\'s your name?']) !!}

{!! Form::label('birthdate', 'Birthdate') !!}
{!! Form::text('birthdate',  null, ['placeholder' => 'MM/DD/YYYY']) !!}

@if(get_login_type() == 'email')
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['placeholder' => 'you@example.com']) !!}
@else
    {!! Form::label('phone', 'Cell Number') !!}
    {!! Form::text('phone', null, ['placeholder' => '555-555-5555']) !!}
@endif