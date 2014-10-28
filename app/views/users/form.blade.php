{{ Form::label('email', 'Email') }}
{{ $errors->first('email', '<span class="validation error">:message</span>') }}
{{ Form::text('email') }}

{{ Form::label('phone', 'Phone') }}
{{ $errors->first('email', '<span class="validation error">:message</span>') }}
{{ Form::text('phone') }}

{{ Form::label('password', 'Password') }}
{{ $errors->first('password', '<span class="validation error">:message</span>') }}
{{ Form::password('password') }}

{{ Form::label('password_confirmation', 'Password Confirmation') }}
{{ $errors->first('password_confirmation', '<span class="validation error">:message</span>') }}
{{ Form::password('password_confirmation') }}
