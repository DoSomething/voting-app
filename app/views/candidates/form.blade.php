{{ Form::label('name', 'Candidate Name') }}
{{ Form::text('name') }}
{{ $errors->first('name', '<span class="message error">:message</span>') }}

{{ Form::label('description', 'Description') }}
{{ Form::textarea('description') }}
{{ $errors->first('description', '<span class="message error">:message</span>') }}
