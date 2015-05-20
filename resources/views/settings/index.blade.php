@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Site Settings</h1>

            <p>These settings allow you to customize this instance of Voting App.</p>

            @include('partials.errors')
        </div>

        <table>
            <thead>
            <tr>
                <td>Setting Name</td>
                <td>Value</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($settings as $setting)
                <tr>
                    {!! Form::model($setting, ['method' => 'PUT', 'route'=> ['settings.update', $setting->key]]) !!}
                    @if($setting->description)
                        <td><strong><abbr title="{{ $setting->description }}">{{ $setting->key }}</abbr></strong></td>
                    @else
                        <td><strong>{{ $setting->key }}</strong></td>
                    @endif
                    <td>
                        @if ($setting->type == 'text')
                            {!! Form::text('value') !!}
                        @elseif ($setting->type == 'boolean')
                            <label class="control checkbox">
                                {!! Form::checkbox('value', 1) !!}
                                <span class="control-indicator"></span>
                                On
                            </label>
                        @else
                            {{ $setting->value }}
                        @endif
                    </td>
                    <td>{!! Form::submit('Save', ['class' => 'button -secondary']) !!}</td>
                    {!! Form::close() !!}
                </tr>

            @empty
                <div class="empty">No settings... yet!</div>
            @endforelse
        </table>
    </div>
@stop
