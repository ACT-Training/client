@props([
    'paginator' => null,
])

@php
    $simple = ! $paginator instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator;
@endphp

@if ($simple)
    <div
        {{ $attributes->class('flex items-center justify-between border-t border-zinc-100 pt-3 dark:border-zinc-700') }}
        data-flux-pagination
    >
        <div></div>

        @if ($paginator->hasPages())
            <div
                class="flex items-center rounded-[8px] border border-zinc-200 bg-white p-[1px] dark:border-white/10 dark:bg-white/10"
            >
                @if ($paginator->onFirstPage())
                    <div
                        class="flex size-8 items-center justify-center rounded-[6px] text-zinc-300 sm:size-6 dark:text-zinc-500"
                    >
                        <flux:icon.chevron-left variant="micro" />
                    </div>
                @else
                    @if (method_exists($paginator, 'getCursorName'))
                        <button
                            type="button"
                            wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}"
                            wire:click="setPage('{{ $paginator->previousCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
                            class="flex size-8 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 sm:size-6 dark:text-white dark:hover:bg-white/20 dark:hover:text-white"
                        >
                            <flux:icon.chevron-left variant="micro" />
                        </button>
                    @else
                        <button
                            type="button"
                            wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            class="flex size-8 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 sm:size-6 dark:text-white dark:hover:bg-white/20 dark:hover:text-white"
                        >
                            <flux:icon.chevron-left variant="micro" />
                        </button>
                    @endif
                @endif

                @if ($paginator->hasMorePages())
                    @if (method_exists($paginator, 'getCursorName'))
                        <button
                            type="button"
                            wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}"
                            wire:click="setPage('{{ $paginator->nextCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
                            class="flex size-8 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 sm:size-6 dark:text-white dark:hover:bg-white/20 dark:hover:text-white"
                        >
                            <flux:icon.chevron-right variant="micro" />
                        </button>
                    @else
                        <button
                            type="button"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            class="flex size-8 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 sm:size-6 dark:text-white dark:hover:bg-white/20 dark:hover:text-white"
                        >
                            <flux:icon.chevron-right variant="micro" />
                        </button>
                    @endif
                @else
                    <div
                        class="flex size-8 items-center justify-center rounded-[6px] text-zinc-300 sm:size-6 dark:text-zinc-500"
                    >
                        <flux:icon.chevron-right variant="micro" />
                    </div>
                @endif
            </div>
        @endif
    </div>
@else
    <div
        {{ $attributes->class('@container flex items-center justify-between gap-3 border-t border-zinc-100 pt-3 dark:border-zinc-700') }}
        data-flux-pagination
    >
        @if ($paginator->total() > 0)
            <div class="text-xs font-medium whitespace-nowrap text-zinc-500 dark:text-zinc-400">
                {!! __('Showing') !!} {{ $paginator->firstItem() }} {!! __('to') !!} {{ $paginator->lastItem() }}
                {!! __('of') !!} {{ $paginator->total() }} {!! __('results') !!}
            </div>
        @else
            <div></div>
        @endif

        @if ($paginator->hasPages())
            {{-- Mobile pagination --}}
            <div
                class="flex items-center rounded-[8px] border border-zinc-200 bg-white p-[1px] @[40rem]:hidden dark:border-white/10 dark:bg-white/10"
            >
                @if ($paginator->onFirstPage())
                    <div
                        aria-disabled="true"
                        aria-label="{{ __('pagination.previous') }}"
                        class="flex size-8 items-center justify-center rounded-[6px] text-zinc-300 sm:size-6 dark:text-zinc-500"
                    >
                        <flux:icon.chevron-left variant="micro" />
                    </div>
                @else
                    <button
                        type="button"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        aria-label="{{ __('pagination.previous') }}"
                        class="flex size-8 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 sm:size-6 dark:text-zinc-400 dark:hover:bg-white/20 dark:hover:text-white"
                    >
                        <flux:icon.chevron-left variant="micro" />
                    </button>
                @endif

                @if ($paginator->hasMorePages())
                    <button
                        type="button"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        aria-label="{{ __('pagination.next') }}"
                        class="flex size-8 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 sm:size-6 dark:text-zinc-400 dark:hover:bg-white/20 dark:hover:text-white"
                    >
                        <flux:icon.chevron-right variant="micro" />
                    </button>
                @else
                    <div
                        aria-label="{{ __('pagination.next') }}"
                        class="flex size-8 items-center justify-center rounded-[6px] text-zinc-300 sm:size-6 dark:text-zinc-500"
                    >
                        <flux:icon.chevron-right variant="micro" />
                    </div>
                @endif
            </div>

            {{-- Desktop pagination --}}
            <div
                class="hidden items-center rounded-[8px] border border-zinc-200 bg-white p-[1px] @[40rem]:flex dark:border-white/10 dark:bg-white/10"
            >
                @if ($paginator->onFirstPage())
                    <div
                        aria-disabled="true"
                        aria-label="{{ __('pagination.previous') }}"
                        class="flex size-6 items-center justify-center rounded-[6px] text-zinc-300 dark:text-zinc-500"
                    >
                        <flux:icon.chevron-left variant="micro" />
                    </div>
                @else
                    <button
                        type="button"
                        wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        aria-label="{{ __('pagination.previous') }}"
                        class="flex size-6 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-white/20 dark:hover:text-white"
                    >
                        <flux:icon.chevron-left variant="micro" />
                    </button>
                @endif

                @foreach (\Livewire\invade($paginator)->elements() as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <div
                            aria-disabled="true"
                            class="flex size-6 cursor-default items-center justify-center rounded-[6px] text-xs font-medium text-zinc-400 dark:text-zinc-400"
                        >
                            {{ $element }}
                        </div>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <div
                                    wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                                    aria-current="page"
                                    class="flex h-6 cursor-default items-center justify-center rounded-[6px] px-2 text-xs font-medium text-zinc-800 dark:text-white"
                                >
                                    {{ $page }}
                                </div>
                            @else
                                <button
                                    wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                    type="button"
                                    class="h-6 rounded-[6px] px-2 text-xs font-medium text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-white/20 dark:hover:text-white"
                                >
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <button
                        type="button"
                        wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        aria-label="{{ __('pagination.next') }}"
                        class="flex size-6 items-center justify-center rounded-[6px] text-zinc-400 hover:bg-zinc-100 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-white/20 dark:hover:text-white"
                    >
                        <flux:icon.chevron-right variant="micro" />
                    </button>
                @else
                    <div
                        aria-label="{{ __('pagination.next') }}"
                        class="flex size-6 items-center justify-center rounded-[6px] text-zinc-300 dark:text-zinc-500"
                    >
                        <flux:icon.chevron-right variant="micro" />
                    </div>
                @endif
            </div>
        @endif
    </div>
@endif
