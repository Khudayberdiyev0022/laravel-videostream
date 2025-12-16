<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name'))</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  @stack('styles')
</head>
<body class="container">
<!-- Header -->
@include('layouts.partials.header')

<!-- Breadcrumb -->
@if(isset($breadcrumbs) && $breadcrumbs->count() > 1)
  <x-breadcrumb :items="$breadcrumbs" />
@endif

<!-- Main Content -->
<main class="main-content py-4">
  @yield('content')
</main>

<!-- Footer -->
@include('layouts.partials.footer')

<!-- Mobile Menu -->
{{--@include('layouts.partials.mobile-menu')--}}

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
