@extends('app')

@section('content')
    <div class="wrapper">
        <h3> {{ $winner->candidate->name }} </h3>

        {!! Form::model($winner, ['method' => 'PUT', 'route'=> ['winners.update', $winner->id]]) !!}
        {!! Form::label('description', 'Winner description') !!}
        {!! Form::textarea('description') !!}

        {!! Form::label('rank', 'Rank') !!}
        {!! Form::selectRange('rank', 1, 20) !!}

        {!! Form::submit('Update Winner', ['class' => 'btn']) !!}
        {!! Form::close() !!}
    </div>
    <div class="wrapper">
        <a class="button -danger" href="{{ route('winners.destroy', [$winner->id]) }}" data-confirm="Are you sure you want to remove this candidate from the winners list?" data-method="DELETE">Remove Winner</a>
    </div>
@stop
