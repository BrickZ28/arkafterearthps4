@component('mail::message')
# Hello {{$name}}

Thank you for verifying your email and of course joining our server.  We hope you enjoy your time here as we try to give a balanced and fun experience.

Before we can get you your starter kit and ability to use Discord to its fullest please follow the below steps
1.  If you haven't done so already register on discord, you can use this link https://discord.gg/RnUXfdy
2. Once in discord you will be put in the welcome channel asking you to select your play style, PVP or PVE in the #welcome channel.  In the #welcome channel select your play style using the emojis.
![See attached]({{asset('/img/profile/style.png')}})
3. Now go to the #code channel and insert your registration code: **{{$code}}**
4.  Now just browse around discord and read the channels.  Once an admin verifies your code you will receive another email with instructions on how to get your starter kit.
5.  Follow the rules below

DISCORD RULES
No religious or political discussions.
No mass spamming. This includes sending unsolicited DMs to other users.
DM's about general questions will be ignored by Admins. Most answers are within the channels, or you can ask your questions in the channels someone will help you.



Thanks,<br>
{{ config('app.name') }}
@endcomponent
