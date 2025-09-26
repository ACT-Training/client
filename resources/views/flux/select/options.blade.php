@aware(['searchable'])

@props([
    'searchable' => null,
    'search' => null,
    'empty' => null,
])

@php
    $classes = Flux::classes()
        ->add('[:where(&)]:min-w-48 [:where(&)]:max-h-[20rem] p-[.3125rem]')
        ->add('rounded-lg shadow-xs')
        ->add('border border-zinc-200 dark:border-zinc-600')
        ->add('bg-white dark:bg-zinc-700');

    // Searchable can also be a slot...
    if (is_object($searchable)) {
        $search = $searchable;
    }
@endphp

<?php if (! $searchable) { ?>

<ui-options
    popover="manual"
    {{ $attributes->class($classes) }}
    data-flux-options
>
    {{ $slot }}
</ui-options>

<?php } else { ?>

<div
    popover="manual"
    class="rounded-lg border border-zinc-200 bg-white p-[.3125rem] shadow-xs dark:border-zinc-600 dark:bg-zinc-700 [&:popover-open]:flex [&:popover-open]:flex-col [:where(&)]:min-w-48"
    data-flux-options
>
    <?php if ($search) { ?>

    {{ $search }}

    <?php } else { ?>

    <flux:select.search />

    <?php } ?>

    <ui-options
        class="-me-[.3125rem] -mt-[.3125rem] -mb-[.3125rem] max-h-[20rem] overflow-y-auto pe-[.3125rem] pt-[.3125rem] pb-[.3125rem]"
    >
        {{ $slot }}

        <?php if ($empty) { ?>

        <ui-empty class="data-hidden:hidden">{{ $empty }}</ui-empty>

        <?php } else { ?>

        <flux:select.empty>{!! __('No results found') !!}</flux:select.empty>

        <?php } ?>
    </ui-options>
</div>

<?php } ?>
