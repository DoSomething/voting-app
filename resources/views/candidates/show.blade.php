@extends('app')

@section('title', $candidate->name)
@section('meta_title', $candidate->name)
@section('meta_description', 'Vote for ' . $candidate->name . ' in ' . $settings['site_title'] . '.')
@section('meta_image', URL::to($candidate->thumbnail()))

@section('content')
    <div class="candidate">
        <div class="candidate__info">
            <article class="tile -alternate">
                <a class="wrapper" href="{{ route('candidates.show', [$candidate->slug]) }}">
                    <div class="tile__meta">
                        <h1>{{ $candidate->name }}</h1>
                    </div>
                    <img alt="{{ $candidate->name }}" src="{{ $candidate->thumbnail() }}"/>
                </a>
            </article>

            @if($candidate->description)
                <p class="candidate__description">{{ $candidate->description }}</p>
            @endif
            @if ($candidate->photo_source)
                <a href="{{ $candidate->photo_source }}">Photo Credit</a>
            @endif
        </div>

        <div class="candidate__actions">
            @include('candidates.partials.voteForm', ['category' => $candidate->category, 'id' => $candidate->id])

            @if(Auth::user() && Auth::user()->hasRole('admin') && $vote_count)
                <h4>Hey, beautiful administrator. This candidate
                    has {{ $vote_count }} {{ str_plural('vote', $vote_count)}}.</h4>
            @endif
        </div>
    </div>
@stop

@section('actions')
    @if(Auth::user() && Auth::user()->hasRole('admin'))
        <li><a href="{{ route('candidates.edit', [$candidate->slug]) }}">Edit Candidate</a></li>
        <li><a href="{{ route('candidates.destroy', [$candidate->slug]) }}" data-method="DELETE" data-confirm="Are you sure you want to delete this candidate, and all their votes?" class="button -danger">Delete Candidate</a></li>
    @endif
@stop
