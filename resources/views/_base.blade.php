<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @if (Auth::check())
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
  @endif

  <title>@yield('page-title', config('app.name'))</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  @stack('header-styles')
</head>
<body class="@yield('body-class', '')">
<div class="flex-center position-ref full-height">
  <div class="content">
    @yield('content')
  </div>
</div>
@stack('body-scripts-before-app')
<script src="{{ mix('js/app.js') }}"></script>
@stack('body-scripts')
</body>
</html>