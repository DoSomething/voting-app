@extends('layout')

@section('content')
  <div class="wrapper">
    <h1 class="highlighted">Administrator Sign In</h1>
    <p>With great power, comes great responsibility...</p>

    @include('sessions/partials/_' . $type)
  </div>

@stop
