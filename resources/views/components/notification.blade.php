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
        <a href="#" onclick="acceptChange({{ $notification->data['data']['id'] }})" class="card-link text-success">Accept</a>
        <a href="#" onclick="rejectChange({{ $notification->data['data']['id'] }})" class="card-link text-danger">Reject</a>
      </div>
      <div class="card-body">
        @if ($notification->read_at === null)
          <a href="#" class="card-link text-muted">Mark as Read</a>
        @else
          <a href="#" class="card-link text-muted">Mark as Unread</a>
        @endif
      </div>
      @break
    @endswitch
  @if ($notification->invalid)
    </s>
  @endif
</div>