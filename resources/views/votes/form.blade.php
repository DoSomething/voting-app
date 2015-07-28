{{-- If voting is disabled, show a 'voting is closed' message. --}}
@if(!setting('enable_voting'))
    <p class="heading -alpha">Voting is closed for {{{ setting('site_title') }}}.</p>
    {{-- If winners are not being shown... --}}
    @if(!setting('show_winners'))
        <p class="heading -gamma">We'll post the results soon!</p>
    @else
        {{-- Winners being shown --}}
        <p>{{ $winner->description or "WINNER_DESCRIPTION" }}</p>
    @endif

{{-- If user is logged in... --}}
@elseif(Auth::user())

    {{--  ...and can vote, show the voting form.  --}}
    @if (Auth::user()->canVote())
        <p class="heading -hero">Hey, {{ Auth::user()->first_name }}! Ready to cast your vote?</p>
        {!! Form::open(['route' => 'votes.store']) !!}
            <input type="hidden" name="candidate_id" value="{{ $id or 'CANDIDATE_ID' }}"/>
            {!! Form::submit('Count My Vote', ['class' => 'button -primary']) !!}
        {!! Form::close() !!}

    {{-- ...and already voted, display a message. --}}
    @else
        <p class="heading -alpha">Thanks for voting! You can vote again in 24 hours.</p>
        <p class="heading -gamma">Get {{ $candidate->name or 'CANDIDATE_NAME' }} more votes!</p>
        @include('candidates.partials.share')
    @endif

{{-- Else, user is not logged in, so show the login/vote form. --}}
@else
    {!! Form::open(['route' => 'votes.store']) !!}
    @include('auth.form')
    <input type="hidden" name="candidate_id" value="{{ $candidate->id or 'CANDIDATE_ID' }}"/>
    {!! Form::submit('Count My Vote', ['class' => 'button -primary']) !!}

    @if(is_domestic_session() || should_collect_international_phone())
        <p class="legal">
            By voting you agree to receive future updates from DoSomething.org. Message &amp; data
            rates may apply. Text STOP to opt-out, HELP for help.
        </p>
    @endif
    {!! Form::close() !!}
@endif
