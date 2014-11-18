@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">Site Settings</h1>
      <p>These settings allow you to customize this instance of Voting App.</p>
    </div>

    <ul>
    @forelse($settings as $setting)
      <li>{{ link_to_route('settings.edit', $setting->key, [$setting->key]) }}: {{{ $setting->value }}}</li>
    @empty
      <li>No settings.</li>
    @endforelse
    </ul>
  </div>
@stop
