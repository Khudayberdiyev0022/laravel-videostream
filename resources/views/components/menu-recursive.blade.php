@props(['items', 'depth' => 0])

<div class="d-flex justify-content-end flex-grow-1">
    @if($items && $items->count() > 0)
        <ul class="{{ $depth === 0 ? 'navbar-nav' : 'dropdown-menu' }}">
            @foreach($items as $item)
            <li class="nav-item {{ $item->children->isNotEmpty() ? ($depth === 0 ? 'dropdown' : 'dropend') : '' }}">
              <a href="{{ $item->full_url }}"
                 target="{{ $item->target }}"
                 class="nav-link {{ $item->children->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                 @if($item->children->isNotEmpty())
                   data-bs-toggle="dropdown"
                 role="button"
                 aria-expanded="false"
                  @endif
              >
                @if($item->icon)
                  <i class="{{ $item->icon }} me-1"></i>
                @endif
                {{ $item->name }}
              </a>

              @if($item->children->isNotEmpty())
                <x-menu-recursive :items="$item->children" :depth="$depth + 1" />
              @endif
            </li>

            {{--                <li class="nav-item {{ $item->children->isNotEmpty() ? 'dropdown' : '' }}">--}}
{{--                    <a href="{{ $item->full_url }}"--}}
{{--                       target="{{ $item->target }}"--}}
{{--                       class="nav-link {{ $item->children->isNotEmpty() ? 'dropdown-toggle' : '' }}"--}}
{{--                       @if($item->children->isNotEmpty())--}}
{{--                           data-bs-toggle="dropdown"--}}
{{--                       role="button"--}}
{{--                       aria-expanded="false"--}}
{{--                        @endif>--}}
{{--                        @if($item->icon)--}}
{{--                            <i class="{{ $item->icon }} me-1"></i>--}}
{{--                        @endif--}}
{{--                        {{ $item->name }}--}}
{{--                    </a>--}}

{{--                    @if($item->children->isNotEmpty())--}}
{{--                        <x-menu-recursive :items="$item->children" :depth="$depth + 1" />--}}
{{--                    @endif--}}
{{--                </li>--}}
            @endforeach
        </ul>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.dropdown-menu .dropdown-toggle').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.stopPropagation();
                e.preventDefault();

                let nextMenu = this.nextElementSibling;
                if (nextMenu && nextMenu.classList.contains('dropdown-menu')) {
                    nextMenu.classList.toggle('show');
                }
            });
        });
    });
</script>
<style>
  .dropend > .dropdown-menu {
    left: 100%;
    top: 0;
  }

</style>
