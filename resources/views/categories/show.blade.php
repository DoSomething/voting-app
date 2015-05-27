@extends('app')

@section('title', $category->name)

@section('content')
    {{-- If there are winners, put them first. --}}
    <ul class="gallery">
        @if($winners)
            @foreach($winners as $winner)
                @include('winners.tile', ['winner' => $winner, 'drawer' => true])
            @endforeach
        @endif
    </ul>

    @if($winners)
        <h1 class="highlighted gallery-heading">All Nominees</h1>
    @endif
    <h2 class="gallery-heading">{{ $category->name }}</h2>

    <ul class="gallery">
        @if($category->candidates)
            @foreach($category->candidates as $candidate)
                @include('candidates.partials.tile', ['candidate' => $candidate, 'drawer' => true])
            @endforeach
        @else
            <li class="empty">No candidates in this category... yet!</li>
        @endif
    </ul>

    <div class="wrapper -narrow">
        <p class="messages -inline">Want to see more candidates? <a href="{{ route('home') }}">View all</a></p>
    </div>

    <div class="wrapper -narrow">
        <h4>Was there a {{ setting('candidate_type') }} we missed?</h4>

        <p>
            If you know a {{ setting('candidate_type') }} who's done kickass things in the world, but don't see them
            on our list, let us know by emailing <a href="mailto:{{ setting('writein_email') }}">{{ setting('writein_email') }}</a>.
            Make sure to include the work they've done in the past year for social good (in 140 characters or less). Thank you!
        </p>
    </div>

    <script type="text/html" id="form-template">
        @include('votes.form', ['candidate' => null, 'winner' => null])
    </script>
@stop
