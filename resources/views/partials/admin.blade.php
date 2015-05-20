@if(Auth::user() && Auth::user()->hasRole('admin'))
    <nav class="admin">
        <ul class="admin__primary">
            <li><a href="{{ route('candidates.index') }}">Candidates</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li><a href="{{ route('winners.index') }}">Winners</a></li>
            <li><a href="{{ route('pages.index') }}">Pages</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('settings.index') }}">Settings</a></li>
        </ul>

        <ul class="admin__secondary">
            <li><a href="{{ url('logout') }}">Sign Out</a></li>
        </ul>
    </nav>
@endif
