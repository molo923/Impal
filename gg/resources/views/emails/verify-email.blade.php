@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $verifyUrl])
Verifikasi Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
