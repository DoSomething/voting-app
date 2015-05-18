@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Winners</h1>

            <p>These are all winners in the database. (Only visible for administrators.)</p>
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
                    <td>{{ $winner->name }}</td>
                    <td>{{ $winner->category }} </td>
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
