@extends('app')

@section('content')
    @forelse($categories as $category)
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
    @empty
        <div class="empty">No categories... yet!</div>
    @endforelse

    <div class="wrapper -narrow">
        <h4>Was there a {{ $settings['candidate_type'] }} we missed?</h4>

        <p>
            If you know a {{ $settings['candidate_type'] }} who's done kickass things in the world, but don't see them
            on our list, let us know by emailing <a href="mailto:writein@celebsgonegood.com">writein@celebsgonegood.com</a>.
            Make sure to include the work they've done in the past year for social good (in 140 characters or less). Thank you!
        </p>
    </div>

    <script type="text/html" id="form-template">
        @include('candidates.partials.voteForm', ['candidate' => null, 'winner' => null])
    </script>
@stop

@section('actions')
    <li><a href="{{ route('candidates.create') }}">New Candidate</a></li>
@stop
