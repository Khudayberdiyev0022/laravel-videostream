@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-12">
        <h1>Menu Tahrirlash</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Menyu</a></li>
            <li class="breadcrumb-item active">{{ $menu->name }}</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
              @csrf
              @method('PUT')
              @include('admin.menus.partials.form')

              <div class="d-flex justify-content-between">
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Bekor qilish
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Yangilash
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Menu Ma'lumotlari</h5>
          </div>
          <div class="card-body">
            <p class="mb-2">
              <strong>Yaratilgan:</strong><br>
              <small class="text-muted">{{ $menu->created_at->format('d.m.Y H:i') }}</small>
            </p>
            <p class="mb-0">
              <strong>Yangilangan:</strong><br>
              <small class="text-muted">{{ $menu->updated_at->format('d.m.Y H:i') }}</small>
            </p>
          </div>
        </div>

        <div class="card mt-3">
          <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Xavfli Zona</h5>
          </div>
          <div class="card-body">
            <p class="small text-muted">
              Menuni o'chirsangiz, barcha pastki menyular ham o'chiriladi.
            </p>
            <form action="{{ route('admin.menus.destroy', $menu) }}"
                  method="POST"
                  onsubmit="return confirm('Ishonchingiz komilmi? Bu amalni qaytarib bo\'lmaydi!')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm w-100">
                <i class="fas fa-trash"></i> O'chirish
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
