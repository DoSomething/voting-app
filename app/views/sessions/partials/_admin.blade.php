
{{ Form::open(['route'=> ['sessions.store'], 'id' => 'sign_in_form']) }}

  {{ Form::label('email', 'Email') }}
  {{ form_error('email', $errors) }}
  {{ Form::text('email') }}

  {{ Form::label('password', 'Password') }}
  {{ form_error('password', $errors) }}
  {{ Form::password('password') }}

  {{ Form::submit('Sign In', ['class' => 'btn']) }}
{{ Form::close() }}
