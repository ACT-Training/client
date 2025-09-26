

@props([
    'sticky' => null,
    'container' => null,
])

@php
    $classes = Flux::classes('[grid-area:header]')
        ->add('z-10 min-h-14')
        ->add($container ? '' : 'flex items-center px-6 lg:px-8');

    if ($sticky) {
        $attributes = $attributes->merge([
            'x-data' => '',
            'x-bind:style' => '{ position: \'sticky\', top: $el.offsetTop + \'px\', \'max-height\': \'calc(100vh - \' + $el.offsetTop + \'px)\' }',
        ]);
    }
@endphp

<header {{ $attributes->class($classes) }} data-flux-header>
    @if ($container)
        <div class="mx-auto flex h-full w-full items-center px-6 lg:px-8 [:where(&)]:max-w-7xl">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</header>
