@extends('layout')

@section('content')

  <div class="row">
    <h1 class="highlighted">All Winners</h1>
    <p>These are all winners in the database. (Only visible for administrators.)</p>
  </div>
  <table>
    <thead>
      <tr>
        <td> Name </td>
        <td> Category </td>
        <td> Rank </td>
      </tr>
    </thead>
    @forelse($winners as $winner)
    <tr>
      <td>{{ link_to_route('candidates.show', $winner->name, [ $winner->slug ]) }}</td>
      <td> {{ $winner->category }} </td>
      <td> {{ $winner->rank }}
    </tr>
    @empty
    <div class="empty">No candidates... yet!</div>
    @endforelse
  </table>
@stop
