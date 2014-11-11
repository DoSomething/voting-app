<li>
  <article class="tile">
    <a class="wrapper" href="{{{ route('candidates.show', [$candidate->slug]) }}}">
      <div class="tile__meta">
        <h1 class="__title">{{{ $candidate->name }}}</h1>
      </div>
      <img alt="{{{ $candidate->name }}}" src="{{{ $candidate->present()->thumbnail }}}" src="" />
    </a>

    {{ link_to_route('candidates.show', 'Vote', [$candidate->slug], ['class' => 'button -round tile__action'])}}
  </article>
</li>


