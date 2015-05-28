@if(!setting('enable_voting'))
    <div class="wrapper">
        <h1 class="highlighted">Sign up for updates!</h1>
        <p>Voting is closed, but sign up to be notified when we're ready!</p>
    </div>
    <div class="wrapper">
        {!! Form::open(['route' => 'users.store']) !!}
        @include('auth.form')
        {!! Form::submit('Send me updates!', ['class' => 'button -primary']) !!}
        {!! Form::close() !!}

        @if(is_domestic_session() || should_collect_international_phone())
            <p class="legal">
                By signing up for updates, you agree to receive future updates from DoSomething.org (duh!).<br/>
                Message &amp; data rates may apply. Text STOP to opt-out, HELP for help.
            </p>
        @endif
    </div>
@endif
