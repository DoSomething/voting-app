@extends('layout')

@section('content')
  <div class="wrapper">

    @include('sessions/partials/_' . $type)
  </div>

@stop
