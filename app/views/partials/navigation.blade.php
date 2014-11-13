<nav class="primary">
  <a class="logo" href="{{{ route('home') }}}"><img src="/dist/images/logo.png" alt="Celebs Gone Good"></a>
  <ul>
    @forelse($categories as $category)
    <li>{{ highlighted_link_to_route('categories.show', $category->name, [$category->slug]) }}</li>
    @empty
    <li>No categories.</li>
    @endforelse

    <li><a href="#">Write In</a></li> {{-- @TODO: Link to write-in form. --}}
  </ul>
</nav>
