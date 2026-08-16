@props([
    'columns' => [],
    'rows' => [],
    'striped' => false,
    'hover' => false,
])

@php
    $dots = [
        'jade' => 'bg-jade-500',
        'zinc' => 'bg-zinc-600',
    ];

    $dotText = [
        'jade' => 'text-jade-400',
        'zinc' => 'text-zinc-500',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'overflow-x-auto rounded-xl border border-white/10 bg-ink-950']) }}>
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="bg-ink-800">
                @foreach ($columns as $column)
                    @php $sortable = $column['sortable'] ?? true; @endphp
                    <th
                        @if ($sortable) data-ui-table-sort @endif
                        @class([
                            'px-4 py-2.5 font-mono text-[11px] font-normal tracking-wider text-zinc-500 uppercase',
                            'text-right' => ($column['align'] ?? null) === 'right',
                            'group/th cursor-pointer transition-colors duration-150 select-none hover:text-zinc-300 data-[dir]:text-jade-400' => $sortable,
                        ])
                    >
                        @if ($sortable)
                            <span class="inline-flex items-center gap-1">
                                {{ $column['label'] }}
                                <svg class="size-3 shrink-0 opacity-0 transition-all duration-150 ease-snap group-hover/th:opacity-60 group-data-[dir]/th:opacity-100 group-data-[dir=desc]/th:rotate-180" viewBox="0 0 12 12" fill="none"><path d="m3 7.5 3-3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        @else
                            {{ $column['label'] }}
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr @class(['border-t border-white/5', 'even:bg-white/3' => $striped, 'transition-colors duration-150 hover:bg-white/5' => $hover])>
                    @foreach ($columns as $column)
                        @php $cell = $row[$column['key']] ?? null; @endphp
                        <td @class(['px-4 py-2.5 text-zinc-300', 'text-right font-mono text-[13px]' => ($column['align'] ?? null) === 'right'])>
                            @if (is_array($cell))
                                <span class="inline-flex items-center gap-1.5 text-[13px] {{ $dotText[$cell['dot'] ?? 'zinc'] ?? $dotText['zinc'] }}">
                                    <span class="size-1.5 rounded-full {{ $dots[$cell['dot'] ?? 'zinc'] ?? $dots['zinc'] }}"></span>
                                    {{ $cell['text'] }}
                                </span>
                            @else
                                {{ $cell }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@once
    <script>
        document.addEventListener('click', (event) => {
            const header = event.target.closest('[data-ui-table-sort]');

            if (!header) {
                return;
            }

            const dir = header.dataset.dir === 'asc' ? 'desc' : 'asc';
            const index = [...header.parentNode.children].indexOf(header);
            const body = header.closest('table').tBodies[0];

            header.parentNode.querySelectorAll('[data-ui-table-sort]').forEach((sibling) => delete sibling.dataset.dir);
            header.dataset.dir = dir;

            const rows = [...body.rows].sort((a, b) => {
                const x = a.cells[index].textContent.trim();
                const y = b.cells[index].textContent.trim();
                const nx = parseFloat(x.replace(/[$,]/g, ''));
                const ny = parseFloat(y.replace(/[$,]/g, ''));
                const order = Number.isNaN(nx) || Number.isNaN(ny) ? x.localeCompare(y) : nx - ny;

                return dir === 'asc' ? order : -order;
            });

            body.append(...rows);
        });
    </script>
@endonce
