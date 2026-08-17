<script setup>
import AuthShell from './Shell.vue';
import AuthProviders from './Providers.vue';
import UiFloatLabel from '../../components/ui/forms/FloatLabel.vue';
import UiInputGroup from '../../components/ui/forms/InputGroup.vue';
import UiPassword from '../../components/ui/forms/Password.vue';
import UiCheckbox from '../../components/ui/forms/Checkbox.vue';
import UiSeparator from '../../components/ui/data-display/Separator.vue';
import UiButton from '../../components/ui/actions/Button.vue';

const to = (screen) => `/templates/auth/screens/${screen}`;
</script>

<template>
    <AuthShell title="Create your workspace" subtitle="Fourteen days on the Scale trial. Four hundred seats, no card up front.">
        <template #action>
            <span class="text-zinc-500">Already on wharf?</span>
            <a :href="to('sign-in')" target="_top" class="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Sign in</a>
        </template>

        <AuthProviders note="SSO after setup" />

        <UiSeparator label="or" class="my-5" />

        <form class="flex flex-col gap-3">
            <UiFloatLabel label="Full name" name="name" autocomplete="name" />
            <UiFloatLabel label="Work email" type="email" name="email" autocomplete="email" />

            <div>
                <UiInputGroup>
                    <input type="text" name="workspace" placeholder="northbeam" autocomplete="off" />
                    <template #suffix>.wharf.app</template>
                </UiInputGroup>
                <p class="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
            </div>

            <UiPassword label="Password" meter class="w-full!" />

            <UiCheckbox class="mt-1" label="I agree to the terms and the data processing addendum" description="Product mail once a month at most. Security notices always." />

            <UiButton class="mt-2 w-full">Create workspace</UiButton>
        </form>

        <div class="mt-4 flex items-center justify-between font-mono text-[11px] text-zinc-600">
            <span>Data region · ap-1 (Taipei)</span>
            <button type="button" class="transition-colors duration-150 hover:text-cream">Change</button>
        </div>
    </AuthShell>
</template>
