@if(Auth::user() && Auth::user()->hasRole('admin'))
  <footer class="admin">
    <div class="column">
      <h4>Administration</h4>
      <ul>
        <li><a href="{{ route('candidates.index') }}">Candidates</a></li>
        <li><a href="{{ route('categories.index') }}">Categories</a></li>
        <li><a href="{{ route('winners.index') }}">Winners</a></li>
        <li><a href="{{ route('pages.index') }}">Pages</a></li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a href="{{ route('settings.index') }}">Settings</a></li>
      </ul>
    </div>

    <div class="column">
      <h4>User</h4>
      <ul>
        <li><a href="{{ route('logout') }}">Sign Out</a></li>
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
