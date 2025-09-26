

@props([
    'badge' => null,
    'aside' => null,
])

@php
    $classes = Flux::classes()
        ->add('inline-flex items-center')
        ->add('text-sm font-medium')
        ->add('[:where(&)]:text-zinc-800 [:where(&)]:dark:text-white');
@endphp

<ui-label {{ $attributes->class($classes) }} data-flux-label>
    {{ $slot }}

    <?php if (is_string($badge)) { ?>

    <span
        class="-my-1 ms-1.5 rounded-[4px] bg-zinc-800/5 px-1.5 py-1 text-xs text-zinc-800/70 dark:bg-white/10 dark:text-zinc-300"
        aria-hidden="true"
    >
        {{ $badge }}
    </span>

    <?php } elseif ($badge) { ?>

    <span class="ms-1.5" aria-hidden="true">
        {{ $badge }}
    </span>

    <?php } ?>

    <?php if ($aside) { ?>

    <span
        class="-my-1 ms-1.5 rounded-[4px] bg-zinc-800/5 px-1.5 py-1 text-xs text-zinc-800/70 dark:bg-white/10 dark:text-zinc-300"
        aria-hidden="true"
    >
        {{ $aside }}
    </span>

    <?php } ?>
</ui-label>
