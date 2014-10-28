{{ Form::label('name', 'Candidate Name') }}
{{ Form::error('name', $errors) }}
{{ Form::text('name') }}

{{ Form::label('category_id', 'Category') }}
{{ Form::error('category_id', $errors) }}
{{ Form::select('category_id', Category::lists('name', 'id'), ( isset($candidate->category) ? $candidate->category : null )); }}

{{ Form::label('description', 'Photo (optional)') }}
{{ Form::error('photo', $errors) }}
{{ Form::file('photo') }}

{{ Form::label('description', 'Description (optional)') }}
{{ Form::error('description', $errors) }}
{{ Form::textarea('description') }}

