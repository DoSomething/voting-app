@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Winners</h1>

            <p>
                These are all the winners in the database. New winners may be marked from the
                <a href="{{ route('candidates.index') }}">Candidates page</a>. (Winners are only visible
                to administrators, until the "show_winners" setting is toggled on.)
            </p>
        </div>
        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Category</td>
                <td>Rank</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($winners as $winner)
                <tr>
                    <td>{{ $winner->candidate->name }}</td>
                    <td>{{ $winner->candidate->category->name }} </td>
                    <td>{{ $winner->rank }}
                    <td><a href="{{ route('winners.edit', [$winner->id]) }}">edit</a></td>
                </tr>
            @empty
                <tr>
                    <td class="empty">No winners... yet!</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </table>

    </div>
@stop
