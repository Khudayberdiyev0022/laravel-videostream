@props(['items', 'depth' => 0])

<div>
    @if($items && $items->count() > 0)
        <ul class="{{ $depth === 0 ? 'navbar-nav' : 'dropdown-menu' }}">
            @foreach($items as $item)
                <li class="nav-item {{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">
                    <a href="{{ $item->full_url }}"
                       target="{{ $item->target }}"
                       class="nav-link {{ $item->children->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                       @if($item->children->isNotEmpty())
                           data-bs-toggle="dropdown"
                       role="button"
                       aria-expanded="false"
                        @endif>
                        @if($item->icon)
                            <i class="{{ $item->icon }} me-1"></i>
                        @endif
                        {{ $item->name }}
                    </a>

                    @if($item->children->isNotEmpty())
                        <x-menu-recursive :items="$item->children" :depth="$depth + 1" />
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
