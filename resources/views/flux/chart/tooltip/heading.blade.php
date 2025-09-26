

@props([
    'field' => 'date',
    'format' => null,
])

@php
    $format = is_array($format) ? \Illuminate\Support\Js::encode($format) : $format;
@endphp

<div
    {{
        $attributes->class([
            'flex items-center justify-between border-b border-zinc-200 bg-zinc-50 p-2 dark:border-zinc-500 dark:bg-zinc-600',
            'text-xs font-medium [:where(&)]:text-zinc-800 dark:[:where(&)]:text-zinc-100',
        ])
    }}
>
    <slot field="{{ $field }}" @if ($format) format="{{ $format }}" @endif></slot>
</div>
