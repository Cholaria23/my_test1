@component('mail::message')
    # New subscriber

    A user with the email {{ $subscriber->email }} signed up for the newsletter

    Thanks, {{ config('app.name') }}
@endcomponent
