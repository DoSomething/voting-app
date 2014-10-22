{{ Form::label('name', 'Category Name') }}
{{ Form::text('name') }}
{{ $errors->first('name', '<span class="message error">:message</span>') }}

{{ Form::label('slug', 'URL Slug') }}
{{ Form::text('slug') }}
{{ $errors->first('slug', '<span class="message error">:message</span>') }}

