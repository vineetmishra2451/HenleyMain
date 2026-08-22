<x-mail::message>
# Verify Your Henley Account

Dear {{ $user->name }},

Welcome to Henley. To complete your registration and safeguard your access to our single-estate botanical reserve, please verify your email address.

<x-mail::button :url="$verificationUrl" color="primary">
Verify Email Address
</x-mail::button>

If you did not create an account with Henley, no further action is required.

Warm regards,  
**Henley Botanical Curators**  
*Pure leaf. Pure intent.*
</x-mail::message>
