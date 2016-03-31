@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Winner Categories</h1>

            <p>These are all winner categories in the database. Each winner may be in one category.</p>
            <p><strong>Note:</strong> These are not the same as <a href="{{ route('categories.index') }}">Categories</a>!
                For example, a candidate may be categorized in "Baseball", but could be categorized as "Top 20"
                when the winners are presented.</p>
        </div>

        @if(! $winnerCategories->isEmpty())
            <table>
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Winners</td>
                    <td>&nbsp;</td>
                </tr>
                </thead>
                @foreach($winnerCategories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->winners->count() }} </td>
                        <td><a href="{{ route('winner-categories.edit', [$category->slug]) }}">edit</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="empty">No winner categories... yet!</div>
        @endif

        <div class="form-actions">
            <a class="button" href="{{ route('winner-categories.create') }}">New Winner Category</a>
        </div>
    </div>
@stop
