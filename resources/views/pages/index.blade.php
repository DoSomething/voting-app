@extends('app')

@section('content')
    <div class="wrapper">
        <div class="row">
            <h1 class="highlighted">All Pages</h1>

            <p>
                These are all pages in the database. Pages are visible to any users with a link. The FAQ link in the
                footer may be set from the <a href="{{ route('settings.index') }}">Settings</a> page.
            </p>
        </div>

        <table>
            <thead>
            <tr>
                <td>Title</td>
                <td>Link</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            </thead>
            @forelse($pages as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td><code>/pages/{{ $page->slug }}</code></td>
                    <td><a href="{{ route('pages.show', [$page->slug]) }}">view</a></td>
                    <td><a href="{{ route('pages.edit', [$page->slug]) }}">edit</a></td>
                </tr>
            @empty
                <tr>
                    <td class="empty">No pages... yet!</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforelse
        </table>

        <div class="form-actions">
            <a class="button" href="{{ route('pages.create') }}">New Page</a>
        </div>
    </div>
@stop
