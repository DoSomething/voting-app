@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Edit Setting: {{ $setting->key }}</h1>

            @if($setting->description)
                <h4>Documentation</h4>
                {{ $setting->description }}
            @endif
        </div>

        @include('partials.errors')

        {!! Form::model($setting, ['route'=> ['settings.update', $setting->key], 'method' => 'PATCH']) !!}
            @if ($setting->type == 'text')
                {!! Form::label('value', 'Value') !!}
                {!! Form::text('value') !!}
            @elseif ($setting->type == 'boolean')
                <label class="control checkbox">
                    {!! Form::checkbox('value', 1) !!}
                    <span class="control-indicator"></span>
                    On
                </label>
            @else
                <div class="messages -inline">This setting can't be changed. :(</div>
            @endif

            {!! Form::submit('Update Setting', ['class' => 'btn']) !!}
        {!! Form::close() !!}
    </div>
@stop
