Hello {{ $agent->username }},

Changes to your Polviks account 

To confirm the changes to your account, please verify your email using the link below:
{{ route('verify-agent', $agent->verification_token) }}

If you believe you did not request for any changes to your account,
please forward this email to care@polviks.com

Kind regards,
Polviks team =)