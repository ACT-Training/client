@aware(['placeholder'])

@props([
    'placeholder' => null,
    'clearable' => false,
    'invalid' => null,
    'size' => null,
])

{{-- For Firefox, we need to reset the inputs padding back to the default as if there is no trailing icon, so the native date input calendar icon is correctly positioned... --}}
<flux:input
    type="date"
    :$invalid
    :$size
    :$placeholder
    :$attributes
    class:input="[@supports(-moz-appearance:none)]:pe-3"
>
    <x-slot name="iconTrailing">
        <?php if ($clearable) { ?>

        <div class="absolute end-0 top-0 bottom-0 flex items-center justify-center pe-10">
            <flux:input.clearable :$size as="div" />
        </div>

        <?php } ?>

        {{-- Hide this button on Firefox because we can't get rid of the default date input calendar icon, so hide ours instead... --}}
        <flux:button
            size="sm"
            square
            variant="subtle"
            class="-me-1 [&:hover>*]:text-zinc-800 dark:[&:hover>*]:text-white [@supports(-moz-appearance:none)]:hidden [[disabled]_&]:pointer-events-none"
        >
            <flux:icon.calendar
                variant="mini"
                class="text-zinc-300 dark:text-white/60 [[disabled]_&]:text-zinc-200! dark:[[disabled]_&]:text-white/40!"
            />
        </flux:button>

        {{-- Show this button only on Firefox as it's a clickable overlay that sits over the top of the default date input calendar icon to display our date picker... --}}
        <flux:button
            size="sm"
            square
            variant="subtle"
            class="absolute! top-2 right-3.5 bottom-2 h-auto! w-6! not-[@supports(-moz-appearance:none)]:hidden sm:top-2 sm:right-3 sm:bottom-2 sm:w-6!"
        />
    </x-slot>
</flux:input>
