{{-- If voting is disabled, show a 'voting is closed' message. --}}
@if(!$settings['enable_voting'])
    <p class="heading -alpha">Voting is closed for {{{ $settings['site_title'] }}}.</p>
    If winners are not being shown...
    @if(!$settings['show_winners'])
        <p class="heading -gamma">We'll post the results soon!</p>
        Winners being shown
    @else
        <p> {{ $winner->description or "WINNER_DESCRIPTION" }} </p>
    @endif

    {{-- If user is logged in... --}}
@elseif(Auth::user())

    {{--  ...and can vote, show the voting form.  --}}
    @if (Auth::user()->canVote())
        <p class="heading -hero">Hey, {{ Auth::user()->first_name }}! Ready to cast your vote?</p>
        {!! Form::open(['route' => 'votes.store']) !!}
        {!! Form::hidden('candidate_id', (isset($id) ? $id : null)) !!}
        {!! Form::submit('Count My Vote', ['class' => 'button -primary']) !!}
        {!! Form::close() !!}

        {{-- ...and already voted, display a message. --}}
    @else
        <p class="heading -alpha">Thanks for voting! You can vote again in 24 hours.</p>
        <p class="heading -gamma">Get {{ $candidate->name or "CANDIDATE_NAME" }} more votes!</p>
        @include('candidates.share')
    @endif

    {{-- If user is not logged in, show the login/vote form. --}}
@else
    {!! Form::open(['route'=> ['sessions.userLogin'], 'id' => 'sign_in_form']) !!}
    @include('sessions.form', [$type])
    {!! Form::hidden('candidate_id', (isset($candidate->id) ? $candidate->id : null)) !!}
    {!! Form::submit('Count My Vote', ['class' => 'button -primary']) !!}
    <p class="legal" id="ctia">By voting you agree to receive future updates from DoSomething.org. Message &amp; data
        rates may apply. Text STOP to opt-out, HELP for help.</p>
    {!! Form::close() !!}
@endif
