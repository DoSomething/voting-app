@extends('layout')

@section('content')
  <h3>All Settings</h3>
  <ul>
  @forelse($settings as $setting)
    <li>{{ link_to_route('settings.edit', $setting->key, [$setting->key]) }}: {{{ $setting->value }}}</li>
  @empty
    <li>No settings.</li>
  @endforelse
  </ul>

@stop
