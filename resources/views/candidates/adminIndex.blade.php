@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Candidates</h1>
        </div>

        <table>
            <thead>
            <tr>
                <td><a class="{{ sort_class('name') }}" href="{{ sort_url('name') }}">Name</a></td>
                <td><a class="{{ sort_class('category') }}" href="{{ sort_url('category') }}">Category</a></td>
                <td><a class="{{ sort_class('votes') }}" href="{{ sort_url('votes') }}">Votes</a></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->category }}</td>
                    <td>{{ $candidate->votes }}</td>
                    <td><a href="{{ route('candidates.edit', [$candidate->slug]) }}">edit</a></td>
                    <td>
                        {!! Form::open(['route' => 'winners.store']) !!}
                            {!! Form::hidden('id', $candidate->id) !!}
                            {!! Form::submit('Mark as Winner') !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <div class="empty">No users... yet!</div>
            @endforelse
        </table>
    </div>
@stop
