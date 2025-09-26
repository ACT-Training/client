<x-layouts.app.header :title="$title ?? null">
    <x-layouts.app.sidebar :title="$title ?? null">
        <flux:main>
            @isset($buttons)
                <div class="mb-6 flex justify-end">
                    {{ $buttons }}
                </div>
            @endisset

            @isset($header)
                <div class="mb-6">
                    {{ $header }}
                </div>
            @endisset

            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
</x-layouts.app.header>
