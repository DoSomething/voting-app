{!! Form::label('name', 'Candidate Name') !!}
{!! Form::text('name') !!}

{!! Form::label('category_id', 'Category') !!}
{!! Form::select('category_id', $categories) !!}

{!! Form::label('photo', 'Photo') !!}
{!! Form::file('photo') !!}

{!! Form::label('photo_source') !!}
{!! Form::text('photo_source', null, ['placeholder' => 'http://example.com']) !!}

{!! Form::label('description') !!}
{!! Form::textarea('description', null, ['rows' => '2']) !!}

{!! Form::label('gender') !!}
{!! Form::select('gender', ['M' => 'Male', 'F' => 'Female', 'X' => 'Neutral']) !!}

{!! Form::label('twitter') !!}
{!! Form::text('twitter', null, ['placeholder' => '@handle']) !!}
