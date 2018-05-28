@component('mail::message')
Hello {{ $agent->username }},

# Welcome to Polviks! 

Thank you for creating an account with us. To continue with your account registration, please verify your email using the link below:

@component('mail::button', ['url' => route('verify-agent', $agent->verification_token)])
Verify account
@endcomponent

We look forward to working with you

Kind regards,<br>
Polviks team =) <br>
{{ config('app.name') }}
@endcomponent