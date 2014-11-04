@extends('layout')

@section('content')
  <h3>All Users</h3>
  <ul>
  @forelse($users as $user)
    <li>{{ link_to_route('users.show', $user->email, $user->id) }}
  @empty
    <li>No users.</li>
  @endforelse
  </ul>

@stop
