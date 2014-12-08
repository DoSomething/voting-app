@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">All Users</h1>
      <p> Currently there are {{ $users->count() }} in the system. </p>
    </div>

    <table>
    <thead>
          <td> Admin </td>
      <tr>
        <td> User </td>
        <td> Contact </td>
        <td> {{ ($user->hasRole('admin') ? '✓' : '') }} </td>
      </tr>
    </thead>
    @forelse($users as $user)
    <tr>
      <td> {{ $user->first_name }} </td>
      <td> {{ $user->phone or $user->email }} </td>
    </tr>
    @empty
      <div class="empty">No users... yet!</div>
    @endforelse
  </table>

    {{ $users->links() }}
@stop
