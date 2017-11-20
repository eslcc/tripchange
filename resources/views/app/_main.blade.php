@extends("_base")

@section("content")
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('app.main') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="{{ route('app.notifications') }}" class="nav-link">
            <span class="badge badge-light {{ Auth::user()->unreadNotifications()->exists() ? 'text-warning' : '' }}">{{ Auth::user()->unreadNotifications()->count() }}</span>
            <span class="sr-only">unseen notifications</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarUser">
            <a class="dropdown-item" href="#">Edit Profile</a>
            <a class="dropdown-item" href="{{ route('logout') }}">Sign out</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    @include('flash::message')
    @yield("main")
  </div>
@endsection

@push('body-scripts-before-app')
  @routes
@endpush
