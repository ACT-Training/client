# Layout Guidelines for Quality App Style

This document provides comprehensive guidelines for setting up layouts that match the look and feel of the Quality application. Follow these guidelines to maintain consistency across similar applications.

## Application Architecture

### Framework Stack
- **Laravel 12** with streamlined file structure
- **Livewire 3** for interactive components
- **Livewire Volt** for single-file components (class-based approach)
- **Flux UI Pro** for component library
- **Tailwind CSS v4** for styling
- **Instrument Sans** font from Bunny Fonts

### Key Dependencies
```json
{
  "livewire/flux-pro": "v2",
  "livewire/livewire": "v3",
  "livewire/volt": "v1",
  "tailwindcss": "v4"
}
```

## Layout Structure

### File Organization
```
resources/views/
├── components/
│   ├── layouts/
│   │   ├── app.blade.php              # Main app layout wrapper
│   │   ├── auth.blade.php             # Auth layout wrapper
│   │   ├── app/
│   │   │   ├── header.blade.php       # Desktop header + mobile sidebar
│   │   │   ├── sidebar.blade.php      # Desktop sidebar + mobile header
│   │   │   └── welcome.blade.php      # Welcome page layout
│   │   └── auth/
│   │       ├── simple.blade.php       # Simple auth layout
│   │       ├── card.blade.php         # Card-based auth layout
│   │       └── split.blade.php        # Split-screen auth layout
│   ├── badges/                        # Brand/logo components
│   ├── breadcrumbs.blade.php          # Breadcrumb navigation
│   └── [other-components].blade.php
├── partials/
│   └── head.blade.php                 # HTML head section
└── livewire/                          # Volt components
```

### Layout Hierarchy

#### Main App Layout (`components/layouts/app.blade.php`)
```blade
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
```

#### Auth Layout (`components/layouts/auth.blade.php`)
```blade
<x-layouts.auth.simple :title="$title ?? null">
    {{ $slot }}
</x-layouts.auth.simple>
```

## Header Component Structure

### Desktop Header + Mobile Sidebar (`app/header.blade.php`)
- **Fixed header**: `h-16 w-full border-b bg-white dark:bg-zinc-800`
- **Dark mode enabled**: `class="dark"` on HTML element
- **Components**:
  - Mobile sidebar toggle (hidden on desktop)
  - Company logo/brand
  - Breadcrumb navigation
  - User profile dropdown with menu

### Key Features:
```blade
<!DOCTYPE html>
<html lang="..." class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header class="fixed top-0 z-50 h-16 w-full border-b border-zinc-200 bg-white px-6 dark:border-zinc-700 dark:bg-zinc-800">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />
        <x-badges.company.act class="ml-2 h-6" />
        <div class="ml-4">
            <x-breadcrumbs class="mb-0" />
        </div>
        <flux:spacer />

        <!-- User Profile Dropdown -->
        <flux:dropdown position="bottom" align="end">
            <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />
            <flux:menu>
                <!-- User info, settings, logout -->
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Mobile Sidebar for smaller screens -->
    <flux:sidebar stashable sticky class="...lg:hidden...">
        <!-- Navigation items -->
    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
    @persist('toast')
        <flux:toast />
    @endpersist
</body>
</html>
```

## Sidebar Component Structure

### Desktop Sidebar + Mobile Header (`app/sidebar.blade.php`)
- **Desktop**: Persistent sidebar with top padding for fixed header
- **Mobile**: Fixed header at bottom with user menu
- **Navigation**: Grouped navigation items with role-based visibility

### Key Features:
```blade
<flux:sidebar sticky stashable class="border-e border-zinc-200 bg-white lg:pt-16 dark:border-zinc-700 dark:bg-zinc-800">
    <flux:navlist variant="outline">
        <flux:navlist.group class="mt-4 space-y-6">
            <flux:navlist.item icon="gauge" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="mb-2 h-12">
                {{ __('navigation.dashboard') }}
            </flux:navlist.item>

            <!-- More navigation items -->

            @role('admin')
                <!-- Admin-only items -->
            @endrole
        </flux:navlist.group>
    </flux:navlist>

    <flux:spacer />

    <!-- Bottom navigation (documentation, etc.) -->
    <flux:navlist variant="outline">
        @local
            <!-- Local environment items -->
        @endlocal
    </flux:navlist>
</flux:sidebar>

<!-- Mobile Header -->
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:spacer />
    <!-- Mobile user dropdown -->
</flux:header>

{{ $slot }}
```

## Styling Guidelines

### CSS Setup (`resources/css/app.css`)

```css
@import '../../node_modules/tailwindcss/dist/lib.d.mts';
@import '../../vendor/livewire/flux/dist/flux.css';

@plugin '@tailwindcss/typography';

@source '../views';
@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../vendor/livewire/flux-pro/stubs/**/*.blade.php';
@source '../../vendor/livewire/flux/stubs/**/*.blade.php';

@custom-variant dark (&:where(.dark, .dark *));

@theme {
  --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';

  /* Use slate colors instead of zinc for consistent grays */
  --color-zinc-50: var(--color-slate-50);
  --color-zinc-100: var(--color-slate-100);
  /* ... continue through zinc-950 */
  --color-accent: var(--color-blue-500);
  --color-accent-content: var(--color-blue-600);
  --color-accent-foreground: var(--color-white);
}

@layer theme {
  .dark {
    --color-accent: var(--color-blue-500);
    --color-accent-content: var(--color-blue-400);
    --color-accent-foreground: var(--color-white);
  }
}
```

### Font Setup (`partials/head.blade.php`)
```blade
<link rel="preconnect" href="https://fonts.bunny.net" />
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
```

### Color Scheme
- **Primary colors**: Blue accent (`--color-blue-500`)
- **Gray scale**: Slate colors (zinc variables mapped to slate)
- **Dark mode**: Enabled by default with `class="dark"` on HTML
- **Backgrounds**:
  - Light: `bg-white`
  - Dark: `bg-zinc-800`
- **Borders**:
  - Light: `border-zinc-200`
  - Dark: `border-zinc-700`

## Component Patterns

### Breadcrumb Navigation
- **Location**: Header component, right after logo
- **Component**: `<x-breadcrumbs class="mb-0" />`
- **Features**:
  - Auto-generates from route
  - Dashboard shown as home icon with orange accent
  - Responsive text sizes
  - Dark mode support

### Navigation Items
- **Height**: `h-12` for consistency
- **Spacing**: `mb-2` between items, `space-y-6` for groups
- **Icons**: Heroicons via Flux UI
- **Current state**: `:current="request()->routeIs('route.pattern')"`
- **Navigation**: `wire:navigate` for SPA-like experience

### User Profile Component
- **Initials display**: `auth()->user()->initials()`
- **Dropdown menu**: Settings, logout with proper CSRF
- **Consistent styling**: Between desktop header and mobile header

### Role-based Visibility
```blade
@role('admin')
    <!-- Admin-only navigation items -->
@endrole

@local
    <!-- Development/local environment items -->
@endlocal
```

## Responsive Design

### Breakpoints
- **Mobile first**: Components show mobile layout by default
- **Desktop**: `lg:` prefix for desktop-specific styles
- **Key breakpoint**: `lg` (1024px)

### Mobile Adaptations
- **Header**: Fixed at top, shows sidebar toggle + user menu
- **Sidebar**: Stashable overlay, hidden by default
- **Navigation**: Full-width items, vertical layout

### Desktop Layout
- **Header**: Fixed top with breadcrumbs
- **Sidebar**: Persistent left sidebar with top padding (`lg:pt-16`)
- **Content**: Main area with proper spacing

## Flux UI Integration

### Required Components
- `flux:header` - Fixed header container
- `flux:sidebar` - Collapsible sidebar container
- `flux:main` - Main content area
- `flux:navlist` - Navigation list container
- `flux:navlist.item` - Individual navigation items
- `flux:dropdown` - User menu dropdown
- `flux:profile` - User avatar/initials
- `flux:toast` - Toast notifications

### Component Configuration
```blade
<!-- Sidebar -->
<flux:sidebar sticky stashable class="...">

<!-- Header -->
<flux:header class="fixed top-0 z-50 h-16 w-full ...">

<!-- Navigation -->
<flux:navlist variant="outline">
    <flux:navlist.group class="mt-4 space-y-6">
        <!-- Items with consistent h-12 height -->
    </flux:navlist.group>
</flux:navlist>
```

## Implementation Checklist

### Initial Setup
- [ ] Install Laravel with Livewire starter kit
- [ ] Add Flux UI Pro dependency
- [ ] Configure Tailwind CSS v4
- [ ] Set up Instrument Sans font
- [ ] Enable dark mode by default

### Layout Components
- [ ] Create `layouts/app.blade.php` wrapper
- [ ] Create `layouts/auth.blade.php` wrapper
- [ ] Build `layouts/app/header.blade.php` with fixed header
- [ ] Build `layouts/app/sidebar.blade.php` with responsive navigation
- [ ] Set up `partials/head.blade.php`

### Styling
- [ ] Import Flux CSS and configure sources
- [ ] Map zinc colors to slate
- [ ] Set up accent colors and dark mode variants
- [ ] Configure font family in theme

### Components
- [ ] Create breadcrumb component with auto-generation
- [ ] Build company logo/brand components
- [ ] Set up user profile dropdown with proper menu structure
- [ ] Implement role-based navigation visibility

### Testing
- [ ] Verify responsive behavior across breakpoints
- [ ] Test dark mode functionality
- [ ] Ensure navigation state management works
- [ ] Validate role-based visibility
- [ ] Test mobile sidebar toggle functionality

This layout system provides a consistent, professional appearance with excellent responsive behavior and accessibility features through Flux UI Pro components.