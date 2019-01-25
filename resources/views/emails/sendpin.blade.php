@component('mail::message')

    This is to inform you that you have received a new pin for the ArkAfterEarthPS4 server

    Pin:  {{$pin}}
    Gate:  {{$gate}}



    @if($style === 'pve')
    To claim this, you can travel to the Community Center (CC) on Ragnarok by going by the Blue Obelisk
    and use the teleporter to go to the CC.

    Pve Cords 28,49:
 ![See attached]({{asset('/img/pvePikUp.jpg')}})
    @endif
    @if($style === 'pvp')
     To claim this, you can travel to the Community Center (CC) on Ragnarok

     PvP: Viking Bay 2
 ![See attached]({{asset('/img/pvpPikUp.jpg')}})
    @endif


***
 **If you cannot see an image, view in html**

    Thanks,
    {{ config('app.name') }}
@endcomponent
