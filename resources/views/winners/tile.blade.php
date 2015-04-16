<li>
    <article class="tile" data-winner-description="{{ $winner->description }}">
        <a class="wrapper {{ isset($drawer) ? 'js-drawer-link' : '' }}"
           href="{{ route('candidates.show', [$winner->slug]) }}">
            <div class="tile__meta">
                <h1>{{ $winner->name }}</h1>
            </div>
            <img alt="{{{ $winner->name }}}"
                 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                 data-src="/images/thumb-{{{ $winner->photo }}}" width="265" height="265"/>

            <span class="button -round tile__action">{{ $winner->rank }}</span>

        </a>

    </article>
</li>


