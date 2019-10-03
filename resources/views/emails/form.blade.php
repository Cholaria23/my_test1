@component('mail::message')
    # Form Request

    A new user has applied form requst

@if($form->country)
    Country: {{ $form->country }}
@endif
@if($form->city)
    Country: {{ $form->city }}
@endif
@if($form->subject)
    Subject: {{ $form->subject }}
@endif
    User name: {{ $form->name }}
    Surname: {{ $form->surname }}
    Phone: {{ $form->phone }}
    Email: {{ $form->email }}
@if($form->web)
    Web: {{ $form->web }}
@endif
@if($form->post)
    Post: {{ $form->post }}
@endif
@if($form->company_name)
    Company name: {{ $form->company_name }}
@endif
@if($form->business)
    Business: {{ $form->business }}
@endif
    Message: {{ $form->message }}
@if($form->term_3)
    I want to receive email: Yes
@endif

    Thanks, {{ config('app.name') }}
@endcomponent
