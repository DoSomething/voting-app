@if(Auth::user() && Auth::user()->hasRole('admin'))
    <footer class="admin">
        <div class="column">
            <h4>Administration</h4>
            <ul>
                <li>{{ link_to_route('candidates.index', 'Candidates') }}</li>
                <li>{{ link_to_route('categories.index', 'Categories') }}</li>
                <li>{{ link_to_route('winners.index', 'Winners') }}</li>
                <li>{{ link_to_route('pages.index', 'Pages') }}</li>
                <li>{{ link_to_route('users.index', 'Users') }}</li>
                <li>{{ link_to_route('settings.index', 'Site Settings') }}</li>
            </ul>
        </div>

        <div class="column">
            <h4>User</h4>
            <ul>
                <li>{{ link_to_route('logout', 'Sign Out') }}</li>
            </ul>
        </div>

        <div class="column">
            <h4>Actions</h4>
            <ul>
                @yield('actions', 'No actions on this page.')
            </ul>
        </div>
    </footer>
@endif
