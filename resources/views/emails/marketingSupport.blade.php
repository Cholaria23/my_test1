@component('mail::message')
    # Request for marketing support

    A new user has applied for marketing support

    User name: {{ $form->name }}
    Surname: {{ $form->surname }}
    Phone: {{ $form->phone }}
    Email: {{ $form->email }}
    Message: {{ $form->message }}

    Thanks, {{ config('app.name') }}
@endcomponent
