@props([
    'label' => null,
    'name' => 'tags',
    'tags' => [],
    'placeholder' => 'Add a tag…',
])

<div {{ $attributes->merge(['class' => 'w-64']) }} data-tags-input>
    @if ($label)
        <label class="mb-1.5 block text-xs text-zinc-500">{{ $label }}</label>
    @endif
    <div class="flex min-h-10 w-full cursor-text flex-wrap items-center gap-1.5 rounded-lg border border-white/10 bg-ink-950 px-2 py-1.5 transition-colors duration-150 focus-within:border-jade-500">
        @foreach ($tags as $tag)
            <span class="flex items-center gap-1 rounded-md bg-jade-500/15 py-0.5 pr-1 pl-2 text-xs text-jade-300" data-tag>
                <span data-tag-label>{{ $tag }}</span>
                <button type="button" data-tag-remove aria-label="Remove {{ $tag }}" class="grid size-4 place-items-center rounded text-jade-500/70 transition-colors duration-150 outline-none hover:text-jade-300 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                    <svg class="size-2.5" viewBox="0 0 16 16" fill="none"><path d="m4 4 8 8M12 4l-8 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                </button>
            </span>
        @endforeach
        <input type="text" placeholder="{{ $placeholder }}" class="h-6 min-w-24 flex-1 bg-transparent text-sm text-zinc-300 outline-none placeholder:text-zinc-600">
    </div>
    <input type="hidden" name="{{ $name }}" value="{{ implode(',', $tags) }}">
    <template>
        <span class="flex items-center gap-1 rounded-md bg-jade-500/15 py-0.5 pr-1 pl-2 text-xs text-jade-300" data-tag>
            <span data-tag-label></span>
            <button type="button" data-tag-remove aria-label="Remove tag" class="grid size-4 place-items-center rounded text-jade-500/70 transition-colors duration-150 outline-none hover:text-jade-300 focus-visible:ring-2 focus-visible:ring-jade-500/70">
                <svg class="size-2.5" viewBox="0 0 16 16" fill="none"><path d="m4 4 8 8M12 4l-8 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </button>
        </span>
    </template>
</div>

@once
    <script>
        const syncTags = (root) => {
            const labels = [...root.querySelectorAll('[data-tag-label]')].map((label) => label.textContent);

            root.querySelector('input[type="hidden"]').value = labels.join(',');
        };

        document.addEventListener('keydown', (event) => {
            const root = event.target.closest('[data-tags-input]');

            if (!root || event.target.type !== 'text') {
                return;
            }

            const value = event.target.value.trim();

            if ((event.key === 'Enter' || event.key === ',') && value !== '') {
                event.preventDefault();

                const tag = root.querySelector('template').content.firstElementChild.cloneNode(true);
                tag.querySelector('[data-tag-label]').textContent = value;
                tag.querySelector('[data-tag-remove]').setAttribute('aria-label', `Remove ${value}`);

                event.target.parentElement.insertBefore(tag, event.target);
                event.target.value = '';
                syncTags(root);
            }

            if (event.key === 'Backspace' && event.target.value === '') {
                root.querySelector('[data-tag]:last-of-type')?.remove();
                syncTags(root);
            }
        });

        document.addEventListener('click', (event) => {
            const remove = event.target.closest('[data-tag-remove]');
            const root = event.target.closest('[data-tags-input]');

            if (!root) {
                return;
            }

            if (remove) {
                remove.closest('[data-tag]').remove();
                syncTags(root);

                return;
            }

            root.querySelector('input[type="text"]').focus();
        });
    </script>
@endonce
