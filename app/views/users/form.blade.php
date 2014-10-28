{{ Form::label('email', 'Email') }}
{{ Form::error('email', $errors) }}
{{ Form::text('email') }}

{{ Form::label('phone', 'Phone') }}
{{ Form::error('phone', $errors) }}
{{ Form::text('phone') }}

{{ Form::label('password', 'Password') }}
{{ Form::error('password', $errors) }}
{{ Form::password('password') }}

{{ Form::label('password_confirmation', 'Password Confirmation') }}
{{ Form::error('password_confirmation', $errors) }}
{{ Form::password('password_confirmation') }}
