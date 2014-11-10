{{ Form::label('key', 'Key') }}
{{ $setting->key }}

{{ Form::label('value', 'Value') }}
{{ Form::error('value', $errors) }}
{{ Form::text('value') }}

