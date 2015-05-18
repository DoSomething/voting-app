@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Edit Candidate: {{ $candidate->name }}</h1>
        </div>

        @include('partials.errors')

        {!! Form::model($candidate, ['method' => 'PUT', 'route' => ['candidates.update', $candidate->slug], 'files' => true]) !!}
            @include('candidates.form')
            {!! Form::submit('Update Candidate') !!}
        {!! Form::close() !!}
    </div>

    <div class="wrapper">
        <p>If this candidate is no longer wanted, you may delete it & all of its votes. This cannot be undone!</p>
        <div class="form-actions">
            <a href="{{ route('candidates.destroy', [$candidate->slug]) }}" data-method="DELETE" data-confirm="Are you sure you want to delete this candidate, and all their votes?" class="button -danger">Delete Candidate</a>
        </div>
    </div>
@stop
