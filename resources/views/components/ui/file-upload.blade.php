@props([
    'name' => 'file',
    'hint' => '10 MB max',
    'multiple' => false,
    'compact' => false,
])

@if ($compact)
    <div {{ $attributes->merge(['class' => 'w-64']) }} data-file-upload>
        <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-white/10 bg-ink-950 p-1.5 transition-colors duration-150 focus-within:border-jade-500 data-dragover:border-jade-500">
            <input type="file" name="{{ $name }}" @if ($multiple) multiple @endif class="sr-only">
            <span class="flex h-7 shrink-0 items-center rounded-md border border-white/10 px-2.5 text-xs font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">Choose file</span>
            <span class="truncate text-xs text-zinc-600" data-file-summary data-empty="No file selected">No file selected</span>
        </label>
        <ul data-file-list class="mt-2 hidden flex-col gap-1.5"></ul>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'w-72']) }} data-file-upload>
        <label class="grid cursor-pointer place-items-center gap-1.5 rounded-xl border border-dashed border-white/15 bg-ink-950/50 px-4 py-8 text-center transition-colors duration-150 focus-within:border-jade-500 hover:border-white/30 data-dragover:border-jade-500 data-dragover:bg-jade-500/5">
            <input type="file" name="{{ $name }}" @if ($multiple) multiple @endif class="sr-only">
            <svg class="size-5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M8 10.5v-7M5 6l3-2.5L11 6M3 12.5h10" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <p class="text-sm text-zinc-400">Drop {{ $multiple ? 'files' : 'a file' }} here</p>
            <p class="text-xs text-zinc-600">or <span class="text-jade-400">browse</span> · {{ $hint }}</p>
        </label>
        <ul data-file-list class="mt-2 hidden flex-col gap-1.5"></ul>
    </div>
@endif

@once
    <script>
        const uiFileSize = (bytes) => {
            if (bytes >= 1048576) {
                return `${(bytes / 1048576).toFixed(1)} MB`;
            }

            if (bytes >= 1024) {
                return `${Math.round(bytes / 1024)} KB`;
            }

            return `${bytes} B`;
        };

        const uiFileRender = (root) => {
            const input = root.querySelector('input[type="file"]');
            const list = root.querySelector('[data-file-list]');
            const summary = root.querySelector('[data-file-summary]');
            const files = [...input.files];

            if (summary) {
                summary.textContent = files.length === 0 ? summary.dataset.empty : files.length === 1 ? files[0].name : `${files.length} files`;
                summary.classList.toggle('text-zinc-300', files.length > 0);
                summary.classList.toggle('text-zinc-600', files.length === 0);
            }

            list.innerHTML = '';
            list.classList.toggle('hidden', files.length === 0);
            list.classList.toggle('flex', files.length > 0);

            files.forEach((file, index) => {
                const row = document.createElement('li');

                row.className = 'flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 py-2 pr-2 pl-3';
                row.innerHTML = '<svg class="size-3.5 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M9.5 1.5h-5a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4.5l-3-3Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/><path d="M9.5 1.5v3h3" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg><span class="min-w-0 flex-1 truncate text-xs text-zinc-300"></span><span class="shrink-0 font-mono text-[10px] text-zinc-600"></span><button type="button" aria-label="Remove file" class="grid size-5 shrink-0 cursor-pointer place-items-center rounded text-zinc-600 transition-colors duration-150 hover:bg-white/5 hover:text-cream" data-file-remove="' + index + '"><svg class="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3l-6 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></button>';
                row.children[1].textContent = file.name;
                row.children[2].textContent = uiFileSize(file.size);

                list.appendChild(row);
            });
        };

        document.addEventListener('change', (event) => {
            const root = event.target.closest('[data-file-upload]');

            if (root && event.target.type === 'file') {
                uiFileRender(root);
            }
        });

        document.addEventListener('click', (event) => {
            const remove = event.target.closest('[data-file-remove]');

            if (!remove) {
                return;
            }

            const root = remove.closest('[data-file-upload]');
            const input = root.querySelector('input[type="file"]');
            const transfer = new DataTransfer();

            [...input.files].forEach((file, index) => {
                if (index !== Number(remove.dataset.fileRemove)) {
                    transfer.items.add(file);
                }
            });

            input.files = transfer.files;
            uiFileRender(root);
        });

        ['dragover', 'dragleave', 'drop'].forEach((type) => {
            document.addEventListener(type, (event) => {
                const root = event.target.closest?.('[data-file-upload]');

                if (!root) {
                    return;
                }

                event.preventDefault();
                root.querySelector('label').toggleAttribute('data-dragover', type === 'dragover');

                if (type === 'drop') {
                    const input = root.querySelector('input[type="file"]');
                    const transfer = new DataTransfer();

                    [...input.files, ...event.dataTransfer.files].forEach((file) => transfer.items.add(file));

                    input.files = input.multiple ? transfer.files : event.dataTransfer.files;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });
    </script>
@endonce
