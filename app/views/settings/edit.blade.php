@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">Edit Setting: {{{ $setting->key }}}</h1>
      <p>Refer to documentation before changing settings!</p>
    </div>

    {{ Form::model($setting, ['route'=> ['settings.update', $setting->key], 'method' => 'PATCH']) }}
      @include('settings.form')

      {{ Form::submit('Update Setting', ['class' => 'btn']) }}
    {{ Form::close() }}
  </div>
@stop
