

<ui-option
    {{ $attributes }}
    class="flex h-8 items-center gap-2 rounded-lg px-2 text-sm font-medium text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 [&>svg]:text-zinc-400 [&[data-active]>svg]:text-zinc-800 dark:[&[data-active]>svg]:text-white"
>
    {{ $slot }}
</ui-option>
