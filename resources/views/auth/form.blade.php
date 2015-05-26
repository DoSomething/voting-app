@include('partials.errors')

{!! Form::label('first_name', 'First Name') !!}
{!! Form::text('first_name', null, ['placeholder' => 'What\'s your name?']) !!}

{!! Form::label('birthdate', 'Birthdate') !!}
{!! Form::text('birthdate',  null, ['placeholder' => 'MM/DD/YYYY']) !!}

@if(is_international_session())
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['placeholder' => 'you@example.com']) !!}
@endif

@if(should_collect_international_phone())
    {!! Form::label('phone', 'Cell Number (optional)') !!}
    {!! Form::text('phone', null, ['placeholder' => '555-555-5555']) !!}
@endif

@if(is_domestic_session())
    {!! Form::label('phone', 'Cell Number') !!}
    {!! Form::text('phone', null, ['placeholder' => '555-555-5555']) !!}
@endif
