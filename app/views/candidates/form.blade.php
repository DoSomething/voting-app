{{ Form::label('name', 'Candidate Name') }}
{{ $errors->first('name', '<span class="validation error">:message</span>') }}
{{ Form::text('name') }}

{{ Form::label('category_id', 'Category') }}
{{ $errors->first('category_id', '<span class="validation error">:message</span>') }}
{{ Form::select('category_id', Category::lists('name', 'id'), ( isset($candidate->category) ? $candidate->category : null )); }}

{{ Form::label('description', 'Photo (optional)') }}
{{ $errors->first('photo', '<span class="validation error">:message</span>') }}
{{ Form::file('photo') }}

{{ Form::label('description', 'Description (optional)') }}
{{ $errors->first('description', '<span class="validation error">:message</span>') }}
{{ Form::textarea('description') }}

