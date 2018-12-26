@component('mail::message')
   # A new request for a dino has been received, please see below
   <br>
   {{$requestor}} has requested {{$qty}} {{$dinoName}}(s)
   <br>
   The payment amount is {{$total}}

   Thanks,<br>
   {{ config('app.name') }}
@endcomponent
