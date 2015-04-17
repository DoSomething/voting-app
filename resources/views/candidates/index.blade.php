@extends('app')

@section('content')
  <div class="row">
    <h1 class="highlighted">All Candidates</h1>

    <p>These are all candidates in the database. (Only visible for administrators.)</p>
  </div>
  <table>
    <thead>
    <tr>
      <td> {!! sort_candidates_by('name', 'Candidate Name') !!} </td>
      <td> Category
        <ul>
          @forelse($categories as $category)
            <li> {!! filter_candidates_by($category->id, $category->name) !!} </li>
          @empty
            <div class="empty">No categories... yet!</div>
          @endforelse
        </ul>
      </td>
      <td> {!! sort_candidates_by('votes', 'Votes') !!} </td>
      <td>Make Winner</td>

    </tr>
    </thead>
    @forelse($candidates as $candidate)
      <tr>
        <td><a href="{{ route('candidates.show', [ $candidate->slug ]) }}">{{ $candidate->name }}</a></td>
        <td>{{ $candidate->category }}</td>
        <td>{{ $candidate->votes }} votes</td>
        <td>
          {!! Form::open(['route' => 'winners.store']) !!}
          {!! Form::hidden('id', $candidate->id) !!}
          {!! Form::submit('Mark as Winner') !!}
          {!! Form::close() !!}
        </td>
      </tr>
    @empty
      <div class="empty">No candidates... yet!</div>
    @endforelse
  </table>
@stop

@section('actions')
  <li><a href="{{ route('candidates.create') }}">New Candidate</a></li>
@stop
