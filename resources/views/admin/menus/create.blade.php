@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-12">
        <h1>Yangi Menu Yaratish</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Menyu</a></li>
            <li class="breadcrumb-item active">Yangi</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('admin.menus.store') }}" method="POST">
              @csrf
              @include('admin.menus.partials.form')

              <div class="d-flex justify-content-between">
                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Bekor qilish
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Saqlash
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Yordam</h5>
          </div>
          <div class="card-body">
            <h6>URL va Tashqi Havola</h6>
            <p class="small">
              <strong>URL:</strong> Ichki sahifa uchun (masalan: /about)<br>
              <strong>Tashqi havola:</strong> Boshqa sayt uchun (masalan: https://google.com)
            </p>
            <hr>
            <h6>Icon</h6>
            <p class="small">
              Font Awesome class kiriting (masalan: fas fa-home)
            </p>
            <hr>
            <h6>Joylashuv</h6>
            <p class="small">
              Menu qaysi joylarda ko'rinishini tanlang. Bir vaqtning o'zida bir nechta joyda chiqishi mumkin.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
