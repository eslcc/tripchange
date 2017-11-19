@component('mail::message')
  # Change Accepted!

  {{ $target->name }} has accepted your offer to change to {{ $target->has }}!

  Please now get in touch with them, meet up, and let the trips coordinator know about your change.

  Their email is `{{ $target->email }}`. Here is their contact information:

  > {{ $target->contact_info }}

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
