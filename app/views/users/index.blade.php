@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">All Users</h1>
    </div>

    <ul>
    @forelse($users as $user)
      <li>{{ link_to_route('users.show', $user->email, $user->id) }}
    @empty
      <li>No users.</li>
    @endforelse
    </ul>
  </div>
@stop
