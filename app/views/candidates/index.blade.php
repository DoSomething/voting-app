@extends('layout')

@section('content')
  <div class="row">
    <h1 class="highlighted">All Candidates</h1>
    <p>These are all candidates in the database. (Only visible for administrators.)</p>
  </div>
  <table>
    <thead>
      <tr>
        <td> {{ sort_applicants_by('name', 'Candidate Name')}} </td>
        <td>Category</td>
        <td> {{ sort_applicants_by('votes', 'Votes') }} </td>

      </tr>
    </thead>
    @forelse($candidates as $candidate)
    <tr>
      <td>{{ $candidate->name }}</td>
      <td>{{ $candidate->category }}</td>
      <td>{{ ($candidate->votes)}} votes</td>
    </tr>
    @empty
    <div class="empty">No candidates... yet!</div>
    @endforelse
  </table>
@stop

@section('actions')
  <li>{{ link_to_route('candidates.create', 'New Candidate') }}</li>
@stop
