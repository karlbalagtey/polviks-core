Hello {{ $user->username }}

Welcome to Polviks! 

This is your account verification email. To verify your email, please visit the link below:
{{ route('verify-user', $user->verification_token) }}

Kind regards,
Karl Mark Balagtey