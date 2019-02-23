@component('mail::message')
# Thank You {{$user->name}}

Your request for {{$qty}} {{$dinoName}}(s) has been received.
<br>
<br>
Thank you for your payment of {{$total}} gems.  Most orders are completed within 24 hours.  You will receive and email with pickup instructions when completed.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
