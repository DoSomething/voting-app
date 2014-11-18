{{ Form::label('key', 'Key') }}
{{ Form::text('key', null, ['disabled' => true]) }}

{{ Form::label('value', 'Value') }}
{{ form_error('value', $errors) }}
{{ Form::text('value') }}

