

@props([
    'placeholder' => null,
])

<ui-selected-date
    x-ignore
    wire:ignore
    class="flex flex-1 gap-2 truncate text-start text-zinc-700 dark:text-zinc-300 [[disabled]_&]:text-zinc-500 dark:[[disabled]_&]:text-zinc-400"
>
    <template name="placeholder">
        <span
            class="text-zinc-400 dark:text-zinc-400 [[disabled]_&]:text-zinc-400/70 dark:[[disabled]_&]:text-zinc-500"
            data-flux-date-picker-placeholder
        >
            {{ $placeholder ?? new Illuminate\Support\HtmlString('<slot></slot>') }}
        </span>
    </template>

    <template name="date">
        <div dir="auto"><slot></slot></div>
    </template>
</ui-selected-date>
