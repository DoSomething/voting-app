@include('partials.errors')

{!! Form::label('first_name', 'First Name') !!}
{!! Form::text('first_name', null, ['placeholder' => 'What\'s your name?']) !!}

{!! Form::label('birthdate', 'Birthdate') !!}
{!! Form::text('birthdate',  null, ['placeholder' => 'MM/DD/YYYY']) !!}

@if(is_international_session())
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['placeholder' => 'you@example.com']) !!}
@endif

@if(is_domestic_session() || should_collect_international_phone())
    {!! Form::label('phone', trans('forms.phone')) !!}
    {!! Form::text('phone', null, ['placeholder' => trans('forms.phone_placeholder')]) !!}
@endif
