<x-mail::message>
# Welcome to the Reserve

Dear {{ $user->name }},

Thank you for joining Henley. We curate single-origin loose-leaf harvests, rare mountain infusions, and whole biodynamic spices — treating tea with the reverent precision of high fragrance.

Your account is now active. You may explore our seasonal First Flush allocations and build your personal daily ritual.

<x-mail::button :url="config('app.url')" color="primary">
Explore the Collections
</x-mail::button>

Warmest regards,  
**Dr. Alistair Henley & The Curatorial Team**  
*Fifteen quiet minutes for the senses.*
</x-mail::message>
