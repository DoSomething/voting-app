{{ Form::label('email', 'Email') }}
{{ form_error('email', $errors) }}
{{ Form::text('email') }}

{{ Form::label('phone', 'Phone') }}
{{ form_error('phone', $errors) }}
{{ Form::text('phone') }}

{{ Form::label('password', 'Password') }}
{{ form_error('password', $errors) }}
{{ Form::password('password') }}

{{ Form::label('password_confirmation', 'Password Confirmation') }}
{{ form_error('password_confirmation', $errors) }}
{{ Form::password('password_confirmation') }}
