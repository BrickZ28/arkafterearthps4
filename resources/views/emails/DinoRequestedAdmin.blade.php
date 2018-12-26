@component('mail::message')
   # A new request for a dino has been received, please see below
   <br>
   <br>
   {{$requestor}} has requested {{$qty}} {{$dino}}(s)
   <br>
   <br>
   The payment amount is {{$total}}

   Thanks,<br>
   {{ config('app.name') }}
@endcomponent
