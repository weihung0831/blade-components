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
        <x-code-block :code="$panel['code']" />
    </div>
@endforeach
