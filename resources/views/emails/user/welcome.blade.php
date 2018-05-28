@component('mail::message')
Hello {{ $user->username }},

# Welcome to Polviks! 

This is your account verification email. To verify your email, please visit the link below:

@component('mail::button', ['url' => route('verify-user', $user->verification_token)])
Verify email
@endcomponent

Yours truly,<br>
Karl Mark Balagtey<br>
{{ config('app.name') }}
@endcomponent