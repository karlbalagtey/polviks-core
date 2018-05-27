Hello {{ $agent->username }},

Welcome to Polviks! 

Thank you for creating an account with us. To continue with your account registration, please verify your email using the link below:
{{ route('verify-agent', $agent->verification_token) }}

We look forward to working with you

Kind regards,
Polviks team =)