@component('mail::message')


    This is to inform you that a new user has registered and verified their email.

    Name:  {{$user}}



    Thanks,
    {{ config('app.name') }}
@endcomponent
