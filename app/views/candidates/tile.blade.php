<li>
  <article class="tile tile--campaign">
    <a class="wrapper" href="{{{ route('candidates.show', [$candidate->slug]) }}}">
      <div class="tile--meta">
        <h1 class="__title">{{{ $candidate->name }}}</h1>
      </div>
      <img alt="{{{ $candidate->name }}}" src="{{{ $candidate->present()->thumbnail }}}" src="" />
    </a>
  </article>
</li>


