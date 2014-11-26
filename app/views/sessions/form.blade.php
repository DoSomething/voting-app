  {{ Form::label('first_name', 'First Name') }}
  {{ form_error('first_name', $errors) }}
  {{ Form::text('first_name', null, ['placeholder' => 'What\'s your name?']) }}

  {{ Form::label('birthdate', 'Birthdate') }}
  {{ form_error('birthdate', $errors) }}
  {{ Form::text('birthdate',  null, ['placeholder' => 'MM/DD/YYYY']) }}

  @if(get_login_type() == 'email')
    {{ Form::label('email', 'Email') }}
    {{ form_error('email', $errors) }}
    {{ Form::text('email', null, ['placeholder' => 'you@example.com']) }}
  @else
    {{ Form::label('phone', 'Email') }}
    {{ form_error('phone', $errors) }}
    {{ Form::text('phone', null, ['placeholder' => '555-555-5555']) }}
  @endif

