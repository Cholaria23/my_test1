@component('mail::message')
    # New subscriber

    A user with the name {{ $review->name }} added new review

    Thanks, {{ config('app.name') }}
@endcomponent
