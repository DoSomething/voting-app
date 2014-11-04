{{ Form::label('title', 'Title') }}
{{ Form::error('title', $errors) }}
{{ Form::text('title') }}

{{ Form::label('content', 'Page Content') }}
{{ Form::error('content', $errors) }}
{{ Form::textarea('content') }}
