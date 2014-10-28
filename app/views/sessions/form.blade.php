{{ Form::label('email', 'Email') }}
{{ $errors->first('email', '<span class="validation error">:message</span>') }}
{{ Form::text('email') }}

{{ Form::label('password', 'Password') }}
{{ $errors->first('password', '<span class="validation error">:message</span>') }}
{{ Form::password('password') }}
