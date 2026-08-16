<x-layout title="Alert — BLADE-COMPONENTS">
    <div class="mx-auto max-w-4xl px-6 py-16 pb-28">

        <a href="{{ route('components') }}" class="rise inline-flex items-center gap-1.5 text-sm text-zinc-500 transition-colors duration-150 hover:text-cream">
            <svg class="size-3.5" viewBox="0 0 16 16" fill="none"><path d="M9.5 4 5.5 8l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Components
        </a>

        <div class="rise mt-5 flex items-end justify-between" style="animation-delay: 60ms">
            <div>
                <p class="font-mono text-xs tracking-wider text-jade-400 uppercase">{{ $category }}</p>
                <h1 class="mt-1.5 text-3xl font-semibold tracking-tight text-cream">{{ $item['name'] }}</h1>
                <p class="mt-2 max-w-lg text-sm/6 text-zinc-500">
                    An inline callout for things the user should read before moving on. Four severities, an optional title, an actions row, and a dismiss button that removes the element outright.
                </p>
            </div>
            <span class="font-mono text-xs text-zinc-600">{{ sprintf('%02d', $item['variants']) }} variants</span>
        </div>

        @php
            $severityCode = <<<'BLADE'
            <x-ui.alert variant="info" class="w-96">Maintenance window Saturday 02:00–04:00 UTC.</x-ui.alert>
            <x-ui.alert variant="success" class="w-96">Your workspace was upgraded to the Pro plan.</x-ui.alert>
            <x-ui.alert variant="warning" class="w-96">You have used 90% of this month's API quota.</x-ui.alert>
            <x-ui.alert variant="danger" class="w-96">Last invoice payment failed. Retrying in 24 hours.</x-ui.alert>
            BLADE;

            $severityVueCode = <<<'VUE'
            <UiAlert variant="info" class="w-96">Maintenance window Saturday 02:00–04:00 UTC.</UiAlert>
            <UiAlert variant="success" class="w-96">Your workspace was upgraded to the Pro plan.</UiAlert>
            <UiAlert variant="warning" class="w-96">You have used 90% of this month's API quota.</UiAlert>
            <UiAlert variant="danger" class="w-96">Last invoice payment failed. Retrying in 24 hours.</UiAlert>
            VUE;

            $severityReactCode = <<<'REACT'
            <UiAlert variant="info" className="w-96">Maintenance window Saturday 02:00–04:00 UTC.</UiAlert>
            <UiAlert variant="success" className="w-96">Your workspace was upgraded to the Pro plan.</UiAlert>
            <UiAlert variant="warning" className="w-96">You have used 90% of this month's API quota.</UiAlert>
            <UiAlert variant="danger" className="w-96">Last invoice payment failed. Retrying in 24 hours.</UiAlert>
            REACT;

            $titleCode = <<<'BLADE'
            <x-ui.alert variant="warning" title="Trial ends in 3 days" class="w-96">
                Add a payment method to keep your projects online. Nothing is deleted for 30 days after a downgrade.
            </x-ui.alert>
            BLADE;

            $titleVueCode = <<<'VUE'
            <UiAlert variant="warning" title="Trial ends in 3 days" class="w-96">
                Add a payment method to keep your projects online. Nothing is deleted for 30 days after a downgrade.
            </UiAlert>
            VUE;

            $titleReactCode = <<<'REACT'
            <UiAlert variant="warning" title="Trial ends in 3 days" className="w-96">
                Add a payment method to keep your projects online. Nothing is deleted for 30 days after a downgrade.
            </UiAlert>
            REACT;

            $actionsCode = <<<'BLADE'
            <x-ui.alert variant="danger" title="Payment failed" class="w-96">
                We could not charge the card ending in 4242.
                <x-slot:actions>
                    <a href="#" class="text-xs font-medium text-red-300 transition-colors duration-150 hover:text-cream">Update card</a>
                    <a href="#" class="text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">View invoice</a>
                </x-slot>
            </x-ui.alert>
            BLADE;

            $actionsVueCode = <<<'VUE'
            <UiAlert variant="danger" title="Payment failed" class="w-96">
                We could not charge the card ending in 4242.
                <template #actions>
                    <a href="#" class="text-xs font-medium text-red-300 transition-colors duration-150 hover:text-cream">Update card</a>
                    <a href="#" class="text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">View invoice</a>
                </template>
            </UiAlert>
            VUE;

            $actionsReactCode = <<<'REACT'
            <UiAlert
                variant="danger"
                title="Payment failed"
                className="w-96"
                actions={
                    <>
                        <a href="#" className="text-xs font-medium text-red-300 transition-colors duration-150 hover:text-cream">Update card</a>
                        <a href="#" className="text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">View invoice</a>
                    </>
                }
            >
                We could not charge the card ending in 4242.
            </UiAlert>
            REACT;

            $dismissCode = <<<'BLADE'
            <x-ui.alert variant="success" title="Webhook endpoint verified" :dismissible="true" class="w-96">
                Events will start flowing within a minute.
            </x-ui.alert>
            BLADE;

            $dismissVueCode = <<<'VUE'
            <UiAlert variant="success" title="Webhook endpoint verified" dismissible class="w-96">
                Events will start flowing within a minute.
            </UiAlert>
            VUE;

            $dismissReactCode = <<<'REACT'
            <UiAlert variant="success" title="Webhook endpoint verified" dismissible className="w-96">
                Events will start flowing within a minute.
            </UiAlert>
            REACT;
        @endphp

        <div class="mt-12 flex flex-col gap-12">

            <x-demo class="rise" style="animation-delay: 120ms" title="Severities"
                description="Info, success, warning, and danger. Each pairs a tinted surface with a matching icon so the color still reads at a glance."
                :code="$severityCode" :vue-code="$severityVueCode" :react-code="$severityReactCode">
                <div class="flex flex-col gap-3">
                    <x-ui.alert variant="info" class="w-96">Maintenance window Saturday 02:00–04:00 UTC.</x-ui.alert>
                    <x-ui.alert variant="success" class="w-96">Your workspace was upgraded to the Pro plan.</x-ui.alert>
                    <x-ui.alert variant="warning" class="w-96">You have used 90% of this month's API quota.</x-ui.alert>
                    <x-ui.alert variant="danger" class="w-96">Last invoice payment failed. Retrying in 24 hours.</x-ui.alert>
                </div>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 180ms" title="With title"
                description="A bold first line for the headline, body copy underneath for the details."
                :code="$titleCode" :vue-code="$titleVueCode" :react-code="$titleReactCode">
                <x-ui.alert variant="warning" title="Trial ends in 3 days" class="w-96">
                    Add a payment method to keep your projects online. Nothing is deleted for 30 days after a downgrade.
                </x-ui.alert>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 240ms" title="With actions"
                description="An actions slot renders a link row under the body, so the fix is one click away from the complaint."
                :code="$actionsCode" :vue-code="$actionsVueCode" :react-code="$actionsReactCode">
                <x-ui.alert variant="danger" title="Payment failed" class="w-96">
                    We could not charge the card ending in 4242.
                    <x-slot:actions>
                        <a href="#" class="text-xs font-medium text-red-300 transition-colors duration-150 hover:text-cream">Update card</a>
                        <a href="#" class="text-xs text-zinc-500 transition-colors duration-150 hover:text-cream">View invoice</a>
                    </x-slot>
                </x-ui.alert>
            </x-demo>

            <x-demo class="rise" style="animation-delay: 300ms" title="Dismissible"
                description="The close button fades the alert out and removes it from the DOM. Refresh the page to bring this one back."
                :code="$dismissCode" :vue-code="$dismissVueCode" :react-code="$dismissReactCode">
                <x-ui.alert variant="success" title="Webhook endpoint verified" :dismissible="true" class="w-96">
                    Events will start flowing within a minute.
                </x-ui.alert>
            </x-demo>

            <x-install class="rise" style="animation-delay: 360ms" slug="alert" :vue="true" :react="true" />

        </div>
    </div>
</x-layout>
