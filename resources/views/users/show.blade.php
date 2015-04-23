@extends('app')

@section('content')
<div class="wrapper">
    <h3>{{ $user->phone or $user->email}}</h3>

    <h4>First Name:</h4>
    {{ $user->first_name }}

    @if($votes)
        <h4>{{ $vote_count }} {{{ str_plural('vote', $vote_count)}}}</h4>
        <ul>
            @forelse ($votes as $vote)
                <li><a href="{{ route('candidates.show', [$vote->candidate->slug]) }}">{{ $vote->candidate->name }}</a></li>
            @empty
                <li>No votes! :(</li>
            @endforelse
        </ul>
    @endif
</div>
@stop
