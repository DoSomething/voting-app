{{ Form::label('title', 'Title') }}
{{ form_error('title', $errors) }}
{{ Form::text('title') }}

{{ Form::label('content', 'Page Content') }}
{{ form_error('content', $errors) }}
{{ Form::textarea('content') }}
