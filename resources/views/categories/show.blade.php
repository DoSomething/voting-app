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
                @include('candidates.tile', ['candidate' => $candidate, 'drawer' => true])
            @endforeach
        @else
            <li class="empty">No candidates in this category... yet!</li>
        @endif
    </ul>

    <div class="wrapper -narrow">
        <h4>Was there a celeb we missed?</h4>

        <p>
            If you know a celeb who's done kickass things in the world, but don't see them on our list, let us know by
            emailing <a href="mailto:writein@celebsgonegood.com">writein@celebsgonegood.com</a>. Make sure to
            include the work they've done in 2014 for social good (in 140 characters or less). Thank you!
        </p>
    </div>

    <script type="text/html" id="form-template">
        @include('candidates.voteForm', ['candidate' => null, 'winner' => null])
    </script>

@stop

@section('actions')
    <li><a href="{{ route('categories.edit', [$category->slug]) }}">Edit Category</a></li>
@stop
