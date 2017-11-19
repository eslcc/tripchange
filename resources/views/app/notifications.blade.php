@extends("app._main")

@section("main")
  <h1>Notifications</h1>
  <h2>Unread</h2>
  @foreach (Auth::user()->unreadNotifications as $notification)
    @component('components.notification', ['notification' => $notification])
    @endcomponent
  @endforeach
  <h2>All</h2>
  @foreach (Auth::user()->notifications as $notification)
    @component('components.notification', ['notification' => $notification])
    @endcomponent
  @endforeach
@endsection

@push("body-scripts")
  <script>
    function acceptChange(id) {
        if (confirm("If you accept this offer, you will not be able to make or accept another one! Are you sure?")) {
          axios.post(route('api.changes.accept', {id: id}))
              .then(window.location.reload); // TODO error handling
        }
    }
    function rejectChange(id) {
        if (confirm("Are you sure?")) {
            axios.post(route('api.changes.reject', {id: id}))
                .then(window.location.reload); // TODO error handling
        }
    }
  </script>
@endpush
