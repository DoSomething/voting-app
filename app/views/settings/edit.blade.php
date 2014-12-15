@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">Edit Setting: {{{ $setting->key }}}</h1>

      @if($setting->description)
      <h4>Documentation</h4>
      {{{ $setting->description }}}
      @endif
    </div>

    {{ Form::model($setting, ['route'=> ['settings.update', $setting->key], 'method' => 'PATCH']) }}
      @include('settings.form')

      {{ Form::submit('Update Setting', ['class' => 'btn']) }}
    {{ Form::close() }}
  </div>
@stop
