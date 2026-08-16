@php
    $to = fn (string $screen): string => route('templates.screen', ['auth', $screen]);
@endphp

<x-templates.auth.shell title="Create your workspace" subtitle="Fourteen days on the Scale trial. Four hundred seats, no card up front.">
    <x-slot:action>
        <span class="text-zinc-500">Already on wharf?</span>
        <a href="{{ $to('sign-in') }}" target="_top" class="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Sign in</a>
    </x-slot>

    <x-templates.auth.providers note="SSO after setup" />

    <x-ui.separator label="or" class="my-5" />

    <form class="flex flex-col gap-3">
        <x-ui.float-label label="Full name" name="name" autocomplete="name" />
        <x-ui.float-label label="Work email" type="email" name="email" autocomplete="email" />

        <div>
            <x-ui.input-group>
                <input type="text" name="workspace" placeholder="northbeam" autocomplete="off">
                <x-slot:suffix>.wharf.app</x-slot>
            </x-ui.input-group>
            <p class="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
        </div>

        <x-ui.password label="Password" meter class="w-full!" />

        <x-ui.checkbox class="mt-1" label="I agree to the terms and the data processing addendum" description="Product mail once a month at most. Security notices always." />

        <x-ui.button class="mt-2 w-full">Create workspace</x-ui.button>
    </form>

    <div class="mt-4 flex items-center justify-between font-mono text-[11px] text-zinc-600">
        <span>Data region · ap-1 (Taipei)</span>
        <button type="button" class="transition-colors duration-150 hover:text-cream">Change</button>
    </div>
</x-templates.auth.shell>
