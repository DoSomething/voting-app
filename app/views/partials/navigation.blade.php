<nav class="primary">
  <a class="navigation__logo" href="{{{ route('home') }}}"><img src="/dist/images/logo.png" alt="Celebs Gone Good"></a>

  @if(Session::has('flash_message'))
    <div class="messages">{{ Session::get('flash_message') }}</div>
  @else
    <p class="navigation__tagline">Vote for your favorite celeb who has done kick ass things in the world.</p>
  @endif

  <ul>
    @if($categories)
      <li>{{ highlighted_link_to_route('categories.show', $categories[0]->name, [$categories[0]->slug], '/') }}</li>
      @for($i = 1; $i < count($categories); $i++)
      <li>{{ highlighted_link_to_route('categories.show', $categories[$i]->name, [$categories[$i]->slug]) }}</li>
      @endfor
    @else
    <li>No categories.</li>
    @endif

    <li>{{ highlighted_link_to_route('write-in.create', 'Write In') }} </li>
  </ul>
</nav>
