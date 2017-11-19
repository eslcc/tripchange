@component('mail::message')
  # Change Offered

  {{ $source->name }} has offered you a trip change to {{ $source->has }}!

  Visit the {{ config('app.name') }} website to accept or reject this change.

  @component('mail::button', ['url' => ''])
    View Changes
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
