@extends('app')

@section('content')
    @if($categories)
        {!! $gallery !!}

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
    @endif

    @include('users.partials.closed')
@stop
