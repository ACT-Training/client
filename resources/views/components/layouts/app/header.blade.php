<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header
            class="fixed top-0 z-50 h-16 w-full border-b border-zinc-200 bg-white px-6 dark:border-zinc-700 dark:bg-zinc-800"
        >
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

            <x-badges.company.act class="ml-2 h-6" />

            <div class="ml-4">
                <x-breadcrumbs class="mb-0" />
            </div>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="end">
                <flux:profile class="cursor-pointer" :avatar:name="auth()->user()->name" avatar:color="auto" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar :name="auth()->user()->name" color="auto" />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                            Settings
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            variant="danger"
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full"
                        >
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar
            stashable
            sticky
            class="border-e border-zinc-200 bg-zinc-50 lg:hidden dark:border-zinc-700 dark:bg-zinc-900"
        >
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a
                href="{{ route('dashboard') }}"
                class="ms-1 flex items-center space-x-2 rtl:space-x-reverse"
                wire:navigate
            >
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item
                        icon="layout-grid"
                        :href="route('dashboard')"
                        :current="request()->routeIs('dashboard')"
                        wire:navigate
                    >
                        {{ __('navigation.dashboard') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item
                    icon="folder-git-2"
                    href="https://github.com/laravel/livewire-starter-kit"
                    target="_blank"
                >
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item
                    icon="book-open-text"
                    href="https://laravel.com/docs/starter-kits#livewire"
                    target="_blank"
                >
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts

        @persist('toast')
            <flux:toast />
        @endpersist
    </body>
</html>
