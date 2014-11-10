@extends('layout')

@section('content')
  <h3>Setting: {{{ $setting->key }}}</h3>

  {{ Form::model($setting, ['route'=> ['settings.update', $setting->key], 'method' => 'PATCH']) }}
    @include('settings.form')

    {{ Form::submit('Update Setting', ['class' => 'btn']) }}
  {{ Form::close() }}

  <p>{{ link_to_route('settings.index', 'Go Back') }}</p>

@stop
