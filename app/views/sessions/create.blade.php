@extends('layout')

@section('content')
  <h3>Sign In</h3>

    @include('sessions/partials/_' . $type)


@stop
