@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-6">
        <h1>Menyu Boshqaruvi</h1>
      </div>
      <div class="col-md-6 text-end">
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
          <i class="fas fa-plus"></i> Yangi Menu
        </a>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link {{ $location === 'all' ? 'active' : '' }}"
               href="{{ route('admin.menus.index', ['location' => 'all']) }}">
              Hammasi
            </a>
          </li>
          @foreach($locations as $key => $label)
            <li class="nav-item">
              <a class="nav-link {{ $location === $key ? 'active' : '' }}"
                 href="{{ route('admin.menus.index', ['location' => $key]) }}">
                {{ $label }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="card-body">
        @if($menus->isEmpty())
          <div class="text-center py-5">
            <p class="text-muted">Menu topilmadi. Yangi menu yarating.</p>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
              <tr>
                <th width="50">Tartib</th>
                <th>Nomi</th>
                <th>URL</th>
                <th>Joylashuv</th>
                <th>Holat</th>
                <th width="150" class="text-end">Amallar</th>
              </tr>
              </thead>
              <tbody id="sortable-menu">
              @foreach($menus as $menu)
                @include('admin.menus.partials.menu-item', ['menu' => $menu, 'level' => 0])
              @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <style>
    .menu-level-0 { font-weight: 600; }
    .menu-level-1 { padding-left: 30px !important; }
    .menu-level-2 { padding-left: 60px !important; }
    .menu-level-3 { padding-left: 90px !important; }
    .location-badge { font-size: 0.75rem; }
  </style>
@endpush
