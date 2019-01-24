@component('mail::message')

    This is to inform you that you have received a new pin for the ArkAfterEarthPS4 server

    Pin:  {{$pin}}
    Gate:  {{$gate}}

    To claim this, you must go to the Community Center(CC) on Ragnorok by going to the Blue Obelisk or Viking Bay2
    and use the teleporter there to go to the CC.

    Pve Cords 28,49:
    {{asset('/public/img/pvePikUp.jpg')}}


    Thanks,
    {{ config('app.name') }}
@endcomponent
