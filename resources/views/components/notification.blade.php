<div class="card">
  @if ($notification->invalid)
    <s>
      @endif
      @switch($notification->type)
        @case("App\Notifications\ChangeOffered")
        <div class="card-body">
          <h3 class="card-title">Change Offered</h3>
          <div class="card-text">
            {{ $notification->data['data']['source']['data']['name'] }} has offered you a change
            to {{ $notification->data['data']['source']['data']['has'] }}.
          </div>
          @php
            $linkClass1 = $notification->invalid ? 'text-muted' : 'text-success';
            $linkClass2 = $notification->invalid ? 'text-muted' : 'text-danger';
          @endphp
          <a href="#" onclick="acceptChange({{ $notification->data['data']['id'] }})"
             class="card-link {{ $linkClass1 }}">Accept</a>
          <a href="#" onclick="rejectChange({{ $notification->data['data']['id'] }})"
             class="card-link {{ $linkClass2 }}">Reject</a>
        </div>
        @break
      @endswitch
      @if ($notification->invalid)
    </s>
  @endif
</div>