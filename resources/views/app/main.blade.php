@extends("app._main")

@section('main')
  <h1>Trips</h1>

  {{-- TODO: group by trip --}}
  @foreach ($data as $person)
    @php
      $myRequests = $person->changeTargets()->where('state', '!=', 'rejected')->where('source_id', Auth::id());
      $otherRequests = $person->changeTargets()->where('state', '!=', 'rejected')->where('source_id', '!=', Auth::id());
    @endphp
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $person->name }} <span class="badge badge-light">{{ $person->has }}</span></h4>
        @if ($otherRequests->exists())
          <div class="card-text"><i>{{ $otherRequests->count() }} {{ str_plural('request', $otherRequests->count() ) }}
              by other people</i></div>
        @endif
        @if ($myRequests->exists())
          <a href="#" class="card-link text-muted disabled">Change already offered</a>
        @else
          <a href="#" onclick="makeRequest({{ $person->id }})" class="card-link text-primary">Offer Change</a>
        @endif
      </div>
    </div>
  @endforeach
@endsection

@push("body-scripts")
  <script>
      function makeRequest(id) {
          axios.post(route('api.changes.create', {target_id: id}))
              .then(res => {
                  if (res.data.error) {
                      alert(res.data.error.message);
                  } else {
                      window.location.reload();
                  }
              })
              .catch(err => {
                  if (err.response.data.error) {
                      alert(err.response.data.error.message);
                  } else {
                      window.location.reload();
                  }
              });
      }
  </script>
@endpush
