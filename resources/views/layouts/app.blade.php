<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  @stack('css')
  <title>Video Stream</title>
</head>
<body>

<nav class="navbar bg-body-tertiary">
  <div class="container" style="max-width: 1200px">
    <span class="navbar-brand mb-0 h1"><a href="{{ route('videos.index') }}">Navbar</a></span>
  </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@stack('js')
</body>
</html>
