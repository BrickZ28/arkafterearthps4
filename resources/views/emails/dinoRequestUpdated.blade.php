@component('mail::message')
# Hello {{$requestor}},

This is to inform you that your following request has had a status change or update done to it.
<br>
Here is the current status of your request
<br>
Dino:  {{$dinoName}}<br>
Quantity:  {{$qty}}<br>
Status: {{$status}}<br>
Total:  {{$total}}<br>

@if($status === 'completed')
    Transaction Complete, transaction will be done on Ragnarok.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
