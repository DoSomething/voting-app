@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Categories</h1>

            <p>These are all categories in the database. Categories will automatically show up in the site navigation
                above.</p>
        </div>
        <ul>
            @forelse($categories as $category)
                <li>{{ link_to_route('categories.show', $category->name, [$category->slug]) }}</li>
            @empty
                <li>No categories.</li>
            @endforelse
        </ul>
    </div>
@stop

@section('actions')
    <li>{{ link_to_route('categories.create', 'New Category') }}</li>
@stop
