{{ Form::label('key', 'Key') }}
{{ $setting->key }}

{{ Form::label('value', 'Value') }}
{{ form_error('value', $errors) }}
{{ Form::text('value') }}

