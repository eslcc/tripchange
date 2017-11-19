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
            @if (Auth::user()->unreadNotifications()->exists())
              <i class="ion ion-ios-notifications text-warning"></i>
              <span class="badge badge-light">{{ Auth::user()->unreadNotifications()->count() }}</span>
              <span class="sr-only">unseen notifications</span>
            @else
              <i class="ion ion-ios-notifications"></i>
            @endif
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Signed in as <b>{{ Auth::user()->name }}</b> (sign out)</a>
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
