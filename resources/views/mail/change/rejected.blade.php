@component('mail::message')
  # Change Rejected

  Unfortunately, {{ $target->name }} has rejected your offer to change with them.

  You can still ask other people to change.

  @component('mail::button', ['url' => route('app.main')])
    View Offers
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
