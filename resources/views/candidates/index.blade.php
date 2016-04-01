@extends('app')

@section('content')
    @if(setting('show_winners'))
        @react('WinnerIndex', compact('winnerCategories'))
    @endif

    @if(!setting('show_winners') && $categories)

        @react('CandidateIndex', compact('categories', 'query', 'limit'))

        @if(setting('write_ins'))
            <div class="wrapper -narrow">
                {!! setting('write_ins') !!}
            </div>
        @endif

        <script type="text/html" id="form-template">
            @include('votes.form', ['candidate' => null, 'winner' => null])
        </script>
    @endif
@stop
