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

      @if ($setting->type == 'text')
        {{ Form::label('value', 'Value') }}
        {{ form_error('value', $errors) }}
        {{ Form::text('value') }}
      @elseif ($setting->type == 'boolean')
        <label class="control checkbox">
          {{ Form::checkbox('value', null, true) }}
          <span class="control-indicator"></span>
          Enabled
        </label>
        {{ form_error('value', $errors) }}
      @else
        <div class="messages -inline">This setting can't be changed. :(</div>
      @endif

      {{ Form::submit('Update Setting', ['class' => 'btn']) }}
    {{ Form::close() }}
  </div>
@stop
