@component('mail::message')


    This is to inform you that a new user has registered.

    Name:  {{$user}}



    Thanks,
    {{ config('app.name') }}
@endcomponent
