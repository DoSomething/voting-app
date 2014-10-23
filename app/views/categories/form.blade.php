{{ Form::label('name', 'Category Name') }}
{{ Form::text('name') }}
{{ $errors->first('name', '<span class="message error">:message</span>') }}

