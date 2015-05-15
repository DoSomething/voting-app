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

        <p><a href="{{ route('candidates.index') }}">Go Back</a></p>
    </div>
@stop
