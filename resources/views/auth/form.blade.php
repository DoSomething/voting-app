@include('partials.errors')

{!! Form::label('first_name', 'First Name') !!}
{!! Form::text('first_name', null, ['placeholder' => 'What\'s your name?']) !!}

{!! Form::label('birthdate', 'Birthdate') !!}
{!! Form::text('birthdate',  null, ['placeholder' => \VotingApp\LocalizedDate::getExpectedFormat()]) !!}

{!! Form::label('email', 'Email') !!}
{!! Form::text('email', null, ['placeholder' => 'you@example.com']) !!}

@if(should_collect_phone())
    {!! Form::label('mobile', trans('forms.phone') . ' (optional)') !!}
    {!! Form::text('mobile', null, ['placeholder' => trans('forms.phone_placeholder')]) !!}
@endif
