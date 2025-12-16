<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    @if(isset($mobileMenu) && $mobileMenu->count() > 0)
      <ul class="mobile-menu-list list-unstyled">
        @foreach($mobileMenu as $menu)
          <li class="mobile-menu-item {{ $menu->children->isNotEmpty() ? 'has-children' : '' }}">
            <a href="{{ $menu->full_url }}"
               target="{{ $menu->target }}"
               class="d-flex align-items-center justify-content-between py-2 text-decoration-none text-dark">
                            <span>
                                @if($menu->icon)
                                <i class="{{ $menu->icon }} me-2"></i>
                              @endif
                              {{ $menu->name }}
                            </span>
              @if($menu->children->isNotEmpty())
                <i class="fas fa-chevron-down toggle-icon"></i>
              @endif
            </a>

            @if($menu->children->isNotEmpty())
              <ul class="mobile-submenu list-unstyled ms-3 d-none">
                @foreach($menu->children as $child)
                  <li class="mobile-menu-item {{ $child->children->isNotEmpty() ? 'has-children' : '' }}">
                    <a href="{{ $child->full_url }}"
                       target="{{ $child->target }}"
                       class="d-flex align-items-center justify-content-between py-2 text-decoration-none text-dark">
                      <span>{{ $child->name }}</span>
                      @if($child->children->isNotEmpty())
                        <i class="fas fa-chevron-down toggle-icon"></i>
                      @endif
                    </a>

                    @if($child->children->isNotEmpty())
                      <ul class="mobile-submenu list-unstyled ms-3 d-none">
                        @foreach($child->children as $grandchild)
                          <li class="mobile-menu-item">
                            <a href="{{ $grandchild->full_url }}"
                               target="{{ $grandchild->target }}"
                               class="d-block py-2 text-decoration-none text-dark">
                              {{ $grandchild->name }}
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
      </ul>
    @endif
  </div>
</div>

@push('scripts')
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Mobile menu toggle
          document.querySelectorAll('.mobile-menu-item.has-children > a').forEach(function(link) {
              link.addEventListener('click', function(e) {
                  e.preventDefault();

                  const parent = this.parentElement;
                  const submenu = parent.querySelector('.mobile-submenu');
                  const icon = this.querySelector('.toggle-icon');

                  if (submenu) {
                      submenu.classList.toggle('d-none');
                      icon.classList.toggle('fa-chevron-down');
                      icon.classList.toggle('fa-chevron-up');
                  }
              });
          });
      });
  </script>
@endpush
