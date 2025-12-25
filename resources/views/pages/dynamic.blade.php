@extends('layouts.app')
@section('title', $menu->name)
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-title">{{ $menu->name }}</h1>

        <div class="card shadow-sm">
          <div class="card-body p-5">
            <p class="lead">
              Kontent
            </p>
        </div>
      </div>
    </div>
  </div>
@endsection
