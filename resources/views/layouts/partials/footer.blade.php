<footer class="site-footer bg-dark text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <h5>Kompaniya haqida</h5>
        <p class="text-muted">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Sed do eiusmod tempor incididunt ut labore.
        </p>
      </div>

      <div class="col-md-4 mb-4">
        <h5>Foydali havolalar</h5>
        @if(isset($footerMenu) && $footerMenu->count() > 0)
          <ul class="list-unstyled footer-menu">
            @foreach($footerMenu as $menu)
              <li class="mb-2">
                <a href="{{ $menu->full_url }}"
                   target="{{ $menu->target }}"
                   class="text-muted text-decoration-none">
                  @if($menu->icon)
                    <i class="{{ $menu->icon }} me-1"></i>
                  @endif
                  {{ $menu->name }}
                </a>

                @if($menu->children->isNotEmpty())
                  <ul class="list-unstyled ms-3 mt-2">
                    @foreach($menu->children as $child)
                      <li class="mb-2">
                        <a href="{{ $child->full_url }}"
                           target="{{ $child->target }}"
                           class="text-muted text-decoration-none">
                          {{ $child->name }}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        @endif
      </div>

      <div class="col-md-4 mb-4">
        <h5>Bog'lanish</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <i class="fas fa-phone me-2"></i>
            <a href="tel:+998901234567" class="text-muted text-decoration-none">
              +998 90 123 45 67
            </a>
          </li>
          <li class="mb-2">
            <i class="fas fa-envelope me-2"></i>
            <a href="mailto:info@example.com" class="text-muted text-decoration-none">
              info@example.com
            </a>
          </li>
          <li class="mb-2">
            <i class="fas fa-map-marker-alt me-2"></i>
            <span class="text-muted">Toshkent, O'zbekiston</span>
          </li>
        </ul>
      </div>
    </div>

    <hr class="border-secondary">

    <div class="row">
      <div class="col-md-6">
        <p class="text-muted mb-0">
          &copy; {{ date('Y') }} Barcha huquqlar himoyalangan
        </p>
      </div>
      <div class="col-md-6 text-md-end">
        <div class="social-links">
          <a href="#" class="text-muted me-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-muted me-3"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-muted me-3"><i class="fab fa-telegram"></i></a>
          <a href="#" class="text-muted"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>
