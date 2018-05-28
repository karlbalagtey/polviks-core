@component('mail::message')
Hello {{ $user->username }},

# Changes to your Polviks account 

To confirm the changes to your account, please verify your email using the link below:

@component('mail::button', ['url' => route('verify-user', $user->verification_token)])
Confirm account
@endcomponent

@component('mail::panel')
If you believe you did not request for any changes to your account,
please forward this email to security@polviks.com
@endcomponent


Kind regards,<br>
Polviks team =) <br>
{{ config('app.name') }}
@endcomponent