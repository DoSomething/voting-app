@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Winners</h1>

            <p>
                These are all the winners in the database. New winners may be marked from the
                <a href="{{ route('candidates.index') }}">Candidates page</a>. (Winners are only visible
                to administrators until the "show_winners" setting is toggled on.)
            </p>
        </div>
        @if(! $winners->isEmpty())
            <table>
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Category</td>
                    <td>Winner Category</td>
                    <td>Rank</td>
                    <td>&nbsp;</td>
                </tr>
                </thead>
                @foreach($winners as $winner)
                    <tr>
                        <td>{{ $winner->candidate->name }}</td>
                        <td>{{ $winner->candidate->category->name }} </td>
                        <td>{{ $winner->winnerCategory->name or '(uncategorized)' }} </td>
                        <td>{{ $winner->rank or '(unranked)' }}</td>
                        <td><a href="{{ route('winners.edit', [$winner->id]) }}">edit</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="empty">No winners... yet!</div>
        @endif
    </div>
@stop
