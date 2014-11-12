{{ Form::label('name', 'Candidate Name') }}
{{ form_error('name', $errors) }}
{{ Form::text('name') }}

{{ Form::label('category_id', 'Category') }}
{{ form_error('category_id', $errors) }}
{{ Form::select('category_id', Category::lists('name', 'id'), ( isset($candidate->category) ? $candidate->category : null )); }}

{{ Form::label('description', 'Photo (optional)') }}
{{ form_error('photo', $errors) }}
{{ Form::file('photo') }}

{{ Form::label('description', 'Description (optional)') }}
{{ form_error('description', $errors) }}
{{ Form::textarea('description') }}

