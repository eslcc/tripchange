@extends("app._main")

@section('main')
  <h1>Trips</h1>

  {{-- TODO: group by trip --}}
  @foreach ($data as $person)
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $person->name }} <span class="badge badge-light">{{ $person->has }}</span></h4>
        <a href="#{{ $person->id }}" class="card-link">Offer Change</a>
      </div>
    </div>
  @endforeach
@endsection