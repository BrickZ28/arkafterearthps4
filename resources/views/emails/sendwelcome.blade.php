@component('mail::message')
# Hello {{$name}}

Thank you for verifying your email and of course joining our server.  We hope you enjoy your time here as we try to give a balanced and fun experience.

We ask that you adhere to our rules and note the following.

        DISCORD RULES
No religious or political discussions.
No mass spamming. This includes sending unsolicited DMs to other users.
DM's about general questions will be ignored by Admins. Most answers are within the channels, or you can ask your questions in the channels someone will help you.





@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
