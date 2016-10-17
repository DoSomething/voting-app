@extends('app')

@section('content')
    <div class="wrapper">
        <h1 class="highlighted">Administrator Sign In</h1>
        <p>With great power, comes great responsibility...</p>

        <p>
            <a href="{{ url('login') }}" class="button">Sign In with DoSomething.org</a>
        </p>
    </div>
@stop
