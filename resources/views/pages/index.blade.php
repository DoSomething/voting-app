@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Categories</h1>

            <p>These are all pages in the database. Aside from the link in the footer, pages are only accessible with a
                link.</p>
        </div>

        <ul>
            @forelse($pages as $page)
                <li><a href="{{ route('pages.show', [$page->slug]) }}">{{ $page->title }}</a></li>
            @empty
                <li>No pages.</li>
            @endforelse
        </ul>
    </div>
@stop

@section('actions')
    <li><a href="{{ route('pages.create') }}">New Page</a></li>
@stop
