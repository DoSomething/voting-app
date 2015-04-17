@extends('app')

@section('content')
  <div class="wrapper">
    <div class="row">
      <h1 class="highlighted">All Users</h1>

      <p>There are a whopping {{ number_format($count) }} total registered users.</p>
    </div>

    <table>
      <thead>
      <tr>
        <td> User</td>
        <td> Contact</td>
        <td> Admin</td>
      </tr>
      </thead>
      @forelse($users as $user)
        <tr>
          <td> {{ $user->first_name }} </td>
          <td> {{ $user->phone or $user->email }} </td>
          <td> {{ ($user->hasRole('admin') ? '✓' : '') }} </td>
        </tr>
      @empty
        <div class="empty">No users... yet!</div>
      @endforelse
    </table>

    {!! $users->render() !!}
  </div>
@stop
