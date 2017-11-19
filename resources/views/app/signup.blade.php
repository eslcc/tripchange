@extends("app._main")

@section('main')
  <h1>Welcome to {{ config('app.name') }}</h1>
  <p>To finish setup, please answer a few quick questions.</p>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('app.signup.complete') }}" method="post">
    <div class="form-group">
      <label>
        Select which trip you've been assigned
        <select name="has" id="has">
          @foreach (config('app.trips') as $trip)
            <option value="{{ $trip }}">{{ $trip }}</option>
          @endforeach
        </select>
      </label>
    </div>
    <div class="form-group">
      <p>Select which trips you want to change to.</p>

      @foreach (config('app.trips') as $trip)
        <div class="form-check">
          <label class="form-check-label">
            {{-- TODO: filter out the "has" trip from the "wants" list --}}
            <input type="checkbox" name="wants[{{ $trip }}]" class="form-check-input">
            {{ $trip }}
          </label>
        </div>
      @endforeach

    </div>

    <div class="form-group">
      <p><b>If people want to change with you, how should they get in touch with you?</b></p>
      <p>Consider including your email, Facebook profile URL, or phone number. This information won't be shown to
        anyone unless you accept to change with them.</p>

      <textarea name="contact_info" id="contact_info" cols="40" rows="6" class="form-control"></textarea>
    </div>

    {{ csrf_field() }}

    <input type="submit" class="btn btn-primary">
  </form>
@endsection