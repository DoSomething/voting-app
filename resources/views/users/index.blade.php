@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Users</h1>

            <p>There are a whopping {{ number_format($count) }} total registered users.</p>
        </div>

        <table>
            <thead>
            <tr>
                <td>Contact</td>
                <td>Admin</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->phone or $user->email }}</td>
                    <td>{{ ($user->hasRole('admin') ? '✓' : '') }}</td>
                    <td><a href="{{ route('users.show', [$user->id]) }}">details</a></td>
                </tr>
            @empty
                <div class="empty">No users... yet!</div>
            @endforelse
        </table>

        {{-- Pagination --}}
        {!! $users->render() !!}
    </div>
@stop
