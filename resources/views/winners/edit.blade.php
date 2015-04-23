@extends('app')

@section('content')

    <h3> {{ $winner->candidate->name }} </h3>

    {!! Form::model($winner, ['route'=> ['winners.update', $winner->id], 'method' => 'PATCH']) !!}
        {!! Form::label('description', 'Winner description') !!}
        {!! Form::textarea('description') !!}

        {!! Form::label('rank', 'Rank') !!}
        {!! Form::selectRange('rank', 1, 20) !!}

        {!! Form::submit('Update Winner', ['class' => 'btn']) !!}
    {!! Form::close() !!}


    {!! Form::open(['route'=> ['winners.update', $winner->id], 'method' => 'delete']) !!}
        {!! Form::submit('Delete Winner', ['class' => 'button -danger']) !!}
    {!! Form::close() !!}

@stop
