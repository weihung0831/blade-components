@props(['panels'])

@php $tabbed = count($panels) > 1; @endphp

@if ($tabbed)
    <div class="flex items-center gap-1 border-b border-white/5 px-3 py-2">
        @foreach ($panels as $language => $panel)
            <x-code-tab :panel="$language" :active="$loop->first">{{ $panel['label'] }}</x-code-tab>
        @endforeach
    </div>
@endif

@foreach ($panels as $language => $panel)
    <div @if ($tabbed) data-code-panel="{{ $language }}" @endif @class(['hidden' => ! $loop->first])>
        @isset($panel['path'])
            <div class="border-b border-white/5 px-4 py-2 font-mono text-[11px] text-zinc-600">
                Save as <span class="text-zinc-400">{{ $panel['path'] }}</span>
            </div>
        @endisset

        <x-code-block :code="$panel['code']" />
    </div>
@endforeach
