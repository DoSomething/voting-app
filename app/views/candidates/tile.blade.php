<li>
  <article class="tile" data-description="{{ $candidate->description }}">
    <a class="wrapper js-drawer-link" href="{{{ route('candidates.show', [$candidate->slug]) }}}">
      <div class="tile__meta">
        <h1>{{{ $candidate->name }}}</h1>
      </div>
      <img alt="{{{ $candidate->name }}}" src="{{{ $candidate->present()->thumbnail }}}" src="" />
      <span class="button -round tile__action">Vote</span>
    </a>

  </article>
</li>


