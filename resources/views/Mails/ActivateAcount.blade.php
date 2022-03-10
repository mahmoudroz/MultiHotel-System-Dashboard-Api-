@component('mail::message')
# This Code To Verify Your Account
Hello {{$name}}

Copy And Paste This Code To Morog  To Verify Your Account

<b>{{$token}}</b>

Thanks,<br>
{{ config('app.name') }}
@endcomponent