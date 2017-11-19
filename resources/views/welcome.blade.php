@extends('_base')

@section('content')
    <div class="container">
        <h1>Welcome to {{ config('app.name') }}</h1>
        <p>Please sign in with Office 365</p>
        <a href="{{ route('auth.login') }}" class="btn btn-primary">Sign in</a>
    </div>
@endsection