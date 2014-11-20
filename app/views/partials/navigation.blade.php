<nav class="primary">
  <a class="navigation__logo" href="{{{ route('home') }}}"><img src="/dist/images/logo.png" alt="Celebs Gone Good"></a>

  @if(Session::has('flash_message'))
    <div class="messages">{{ Session::get('flash_message') }}</div>
  @else
    <p class="navigation__tagline">Vote for your favorite celeb who has done kick ass things in the world.</p>
  @endif

  <ul>
    @forelse($categories as $category)
    <li>{{ highlighted_link_to_route('categories.show', $category->name, [$category->slug]) }}</li>
    @empty
    <li>No categories.</li>
    @endforelse

    <li>{{ link_to_route('write-in.create', 'Write In') }} </li>
  </ul>
</nav>
