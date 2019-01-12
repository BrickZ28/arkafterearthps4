@component('mail::message')
    # Hello {{$user}},

    This is to inform you that your following request completed.

    Dino:  {{$dinoName}}
    Quantity:  {{$dinoQty}}

    Transaction Complete, transaction will be done on Ragnarok.


    Thanks,
    {{ config('app.name') }}
@endcomponent
