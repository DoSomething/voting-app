{{ Form::label('name', 'Category Name') }}
{{ $errors->first('name', '<span class="validation error">:message</span>') }}
{{ Form::text('name') }}

