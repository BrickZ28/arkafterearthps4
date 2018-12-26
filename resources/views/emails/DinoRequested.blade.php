@component('mail::message')
# Thank You {{$user->name}}

Your request for {{$qty}} {{$dinoName}}(s) has been received.  After payment has been made we will get to work on your dino.
<br>
<br>
As a reminder the payment amount is {{$total}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
