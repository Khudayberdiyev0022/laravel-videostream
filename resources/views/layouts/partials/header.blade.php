<header class="site-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
      </a>

      <button class="navbar-toggler"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#mobileMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <x-menu-recursive :items="$headerMenu" class="ms-auto" />

        <div class="ms-3">
          <a href="#" class="btn btn-primary btn-sm">
            <i class="fas fa-search"></i>
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>
