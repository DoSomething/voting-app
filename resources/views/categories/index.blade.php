@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Categories</h1>

            <p>These are all categories in the database. Each candidate may be in one category.</p>
        </div>

        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Candidates</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->candidates->count() }} </td>
                    <td><a href="{{ route('categories.show', [$category->slug]) }}">view</a></td>
                    <td><a href="{{ route('categories.edit', [$category->slug]) }}">edit</a></td>
                </tr>
            @empty
                <tr>
                    <td class="empty">No winners... yet!</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </table>

        <div class="form-actions">
            <a class="button" href="{{ route('categories.create') }}">New Category</a>
        </div>
    </div>
@stop
