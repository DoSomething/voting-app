<li>
    <article class="tile" data-id="{{ $candidate->id }}" data-description="{{ $candidate->description }}"
             data-twitter="{{ $candidate->share_name }}">
        <a class="wrapper {{ isset($drawer) ? 'js-drawer-link' : '' }}" href="{{ route('candidates.show', [$candidate->slug]) }}">
            <div class="tile__meta">
                <h1>{{ $candidate->name }}</h1>
            </div>
            <img alt="{{ $candidate->name }}" src="{{ $candidate->thumbnail }}" width="265" height="265"/>

            @if(setting('enable_voting'))
                <span class="button -round tile__action">Vote</span>
            @endif
        </a>

    </article>
</li>
