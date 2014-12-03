<nav class="primary">
  <a class="navigation__logo" href="{{{ route('home') }}}"><img src="/dist/images/logo.png" alt="Celebs Gone Good"></a>

  @if(Session::has('flash_message'))
    <div id="message" class="messages {{ Session::get('flash_message_type', '') }}">{{ Session::get('flash_message') }}</div>
  @else
    <p class="navigation__tagline">Vote for your favorite celeb who has done kickass things in the world. Vote once per day in each category, and don't forget voting ends December 24th!</p>
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

    {{-- @TODO: It would be great if this could point to any page. --}}
    <li>{{ highlighted_link_to_route('pages.show', 'FAQ', 'faq') }} </li>
  </ul>
</nav>
