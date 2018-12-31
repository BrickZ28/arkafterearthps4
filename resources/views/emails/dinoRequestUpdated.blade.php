@component('mail::message')
# Hello {{$requestor}},

This is to inform you that your following requesthas had a status change or update done to it.
<br>
Here is the current status of your request
<br>
Dino:  {{$dinoName}}<br>
Quantity:  {{$qty}}<br>
Status: {{$status}}<br>
Total:  {{$total}}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
