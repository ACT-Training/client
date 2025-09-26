@php
    $iconTrailing ??= $attributes->pluck('icon:trailing');
@endphp

@php
    $iconVariant ??= $attributes->pluck('icon:variant');
@endphp

@aware(['variant'])

@props([
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'variant' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
])

@php
    // Button should be a square if it has no text contents...
    $square ??= $slot->isEmpty();

    // Size-up icons in square/icon-only buttons...
    $iconClasses = Flux::classes($square ? 'size-6!' : 'size-6!');

    $classes = Flux::classes()
        ->add('h-9 relative flex items-center gap-3 rounded-lg')
        ->add($square ? 'px-2.5!' : '')
        ->add('py-0 text-start w-full px-3 my-0.5')
        ->add('text-gray-500 dark:text-gray-400')
        ->add(
            match ($variant) {
                'outline' => match ($accent) {
                    true => [
                        'data-current:text-white data-current:bg-orange-500',
                        'hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700',
                        'border-none',
                    ],
                    false => [
                        'data-current:text-white data-current:bg-orange-500',
                        'hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700',
                    ],
                },
                default => match ($accent) {
                    true => [
                        'data-current:text-white data-current:bg-orange-500',
                        'hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700',
                    ],
                    false => [
                        'data-current:text-white data-current:bg-orange-500',
                        'hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700',
                    ],
                },
            },
        );
@endphp

<flux:button-or-link :attributes="$attributes->class($classes)" data-flux-navlist-item>
    <?php if ($icon) { ?>

    <div class="relative">
        <?php if (is_string($icon) && $icon !== '') { ?>

        <flux:icon :$icon :variant="$iconVariant" class="{!! $iconClasses !!}" />

        <?php } else { ?>

        {{ $icon }}

        <?php } ?>

        <?php if ($iconDot) { ?>

        <div class="absolute end-[-2px] top-[-2px]">
            <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
        </div>

        <?php } ?>
    </div>

    <?php } ?>

    <?php if ($slot->isNotEmpty()) { ?>

    <div
        class="flex-1 text-sm leading-none font-medium whitespace-nowrap [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block"
        data-content
    >
        {{ $slot }}
    </div>

    <?php } ?>

    <?php if (is_string($iconTrailing) && $iconTrailing !== '') { ?>

    <flux:icon :icon="$iconTrailing" :variant="$iconVariant" class="size-4!" />

    <?php } elseif ($iconTrailing) { ?>

    {{ $iconTrailing }}

    <?php } ?>

    <?php if (isset($badge) && $badge !== '') { ?>

    <flux:navlist.badge :attributes="Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor])">
        {{ $badge }}
    </flux:navlist.badge>

    <?php } ?>
</flux:button-or-link>
