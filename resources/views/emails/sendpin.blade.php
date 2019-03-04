@component('mail::message')

    This is to inform you that you have received a new pin for the ArkAfterEarthPS4 server

    Gate: {{$gate}}
    Pin:  {{sprintf('%04d', $pin)}}



    @if($style === 'PVE')
        To claim this, you can travel to the Community Center (CC) on Ragnarok by going by the Blue Obelisk or Viking Bay2
        and use the teleporter to go to the CC.

        Pve Cords 28,49:
![See attached]({{asset('/img/pvePikUp.jpg')}})
    @endif
    @if($style === 'PVP')

To claim this, you can travel to Viking Bay 2, by the Community Center (CC) on Ragnarok.

        Vikings bay 2 (20 , 32)
![See attached]({{asset('/img/pvpPikUp.jpg')}})
    @endif


***
 **If you cannot see an image, view in html**

    Thanks,
    {{ config('app.name') }}
@endcomponent
