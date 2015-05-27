@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Candidates</h1>
            <p><strong>Hey, {{ Auth::user()->first_name }}!</strong> You can sort and edit candidates from here, or <a href="?guest=✓">view as a guest</a>.</p>
        </div>

        <table>
            <thead>
            <tr>
                <td><a class="{{ sort_class('name') }}" href="{{ sort_url('name') }}">Name</a></td>
                <td><a class="{{ sort_class('category') }}" href="{{ sort_url('category') }}">Category</a></td>
                <td><a class="{{ sort_class('votes') }}" href="{{ sort_url('votes') }}">Votes</a></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->category }}</td>
                    <td>{{ $candidate->votes }}</td>
                    <td><a href="{{ route('candidates.show', [$candidate->slug]) }}">view</a></td>
                    <td><a href="{{ route('candidates.edit', [$candidate->slug]) }}">edit</a></td>
                    <td><a href="{{ route('winners.store') }}" data-confirm="Mark this candidate as a winner?" data-method="POST" data-form-item="id" data-form-value="{{ $candidate->id }}">mark winner</a></td>
                </tr>
            @empty
                <div class="empty">No users... yet!</div>
            @endforelse
        </table>

        <div class="form-actions">
            <a class="button" href="{{ route('candidates.create') }}">New Candidate</a>
        </div>
    </div>
@stop
