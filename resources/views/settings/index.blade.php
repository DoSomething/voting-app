@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">Site Settings</h1>

            <p>These settings allow you to customize this instance of Voting App.</p>
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
                    <td><strong>{{ $setting->key }}</strong></td>
                    <td>{!! $setting->pretty_value() !!}</td>
                    <td><a href="{{ route('settings.edit', [$setting->key]) }}">edit</a></td>
                </tr>
            @empty
                <div class="empty">No settings... yet!</div>
            @endforelse
        </table>
    </div>
@stop
