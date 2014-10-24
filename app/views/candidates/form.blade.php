{{ Form::label('name', 'Candidate Name') }}
{{ Form::text('name') }}
{{ $errors->first('name', '<span class="message error">:message</span>') }}

{{ Form::label('category_id', 'Category') }}
{{ Form::select('category_id', Category::lists('name', 'id'), ( isset($candidate->category) ? $candidate->category : null )); }}
{{ $errors->first('category_id', '<span class="message error">:message</span>') }}

{{ Form::label('description', 'Photo (optional)') }}
{{ Form::file('photo') }}
{{ $errors->first('photo', '<span class="message error">:message</span>') }}

{{ Form::label('description', 'Description (optional)') }}
{{ Form::textarea('description') }}
{{ $errors->first('description', '<span class="message error">:message</span>') }}

