<x-mail::message>
# Password Reset Request

Dear {{ $user->name }},

We received a request to reset the password associated with your Henley account.

<x-mail::button :url="$resetUrl" color="primary">
Reset Password
</x-mail::button>

This password reset link will expire in 60 minutes. If you did not request this change, please ignore this message; your account credentials remain secure.

With reverence for the leaf,  
**Henley Concierge Security**
</x-mail::message>
