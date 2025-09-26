# Breadcrumbs System Guidelines

This document provides instructions for implementing a custom breadcrumbs system in Laravel applications.

## Architecture Overview

The breadcrumbs system consists of four main components:

1. **BreadcrumbGenerator** - Builds individual breadcrumb trails
2. **Breadcrumbs** - Static facade for defining and generating breadcrumbs
3. **Breadcrumb Component** - Blade component for rendering breadcrumbs
4. **Breadcrumb Definitions** - Configuration file defining all breadcrumb routes

## Implementation Steps

### 1. Create the BreadcrumbGenerator Class

Create `app/Support/BreadcrumbGenerator.php`:

```php
<?php

namespace App\Support;

class BreadcrumbGenerator
{
    protected array $breadcrumbs = [];

    public function push(string $title, ?string $url = null): void
    {
        $this->breadcrumbs[] = (object) [
            'title' => $title,
            'url' => $url,
        ];
    }

    public function parent(string $route, ...$parameters): void
    {
        $parentBreadcrumbs = Breadcrumbs::generate($route, ...$parameters);
        $this->breadcrumbs = array_merge($this->breadcrumbs, $parentBreadcrumbs);
    }

    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }
}
```

### 2. Create the Breadcrumbs Facade

Create `app/Support/Breadcrumbs.php`:

```php
<?php

namespace App\Support;

class Breadcrumbs
{
    protected static array $breadcrumbs = [];

    public static function define(string $route, callable $callback): void
    {
        static::$breadcrumbs[$route] = $callback;
    }

    public static function generate(string $route, ...$parameters): array
    {
        if (! isset(static::$breadcrumbs[$route])) {
            return [];
        }

        $generator = new BreadcrumbGenerator;
        static::$breadcrumbs[$route]($generator, ...$parameters);

        return $generator->getBreadcrumbs();
    }

    public static function generateFromRoute(): array
    {
        $currentRoute = request()->route();

        if (! $currentRoute || ! $currentRoute->getName()) {
            return [];
        }

        return static::generate(
            $currentRoute->getName(),
            ...array_values($currentRoute->parameters())
        );
    }
}
```

### 3. Create the Breadcrumb Blade Component

Create `resources/views/components/breadcrumbs.blade.php`:

```blade
@props(['route' => null, 'params' => []])

@php
    use App\Support\Breadcrumbs;

    $breadcrumbs = [];

    if ($route) {
        $breadcrumbs = Breadcrumbs::generate($route, ...$params);
    } else {
        // Try to generate breadcrumbs from the current route
        $breadcrumbs = Breadcrumbs::generateFromRoute();
    }
@endphp

@if (count($breadcrumbs) > 1)
    <nav {{ $attributes->class('flex items-center space-x-2 text-sm text-gray-500') }}>
        @foreach ($breadcrumbs as $breadcrumb)
            @if (! $loop->last)
                @if ($breadcrumb->url)
                    <a href="{{ $breadcrumb->url }}" class="hover:text-gray-700">
                        {{ $breadcrumb->title }}
                    </a>
                @else
                    <span>{{ $breadcrumb->title }}</span>
                @endif
                <span class="mx-2">/</span>
            @else
                <span class="text-gray-900 font-medium">{{ $breadcrumb->title }}</span>
            @endif
        @endforeach
    </nav>
@endif
```

### 4. Create the Breadcrumb Configuration

Create `config/breadcrumbs.php`:

```php
    <?php

use App\Support\Breadcrumbs;

// Dashboard
Breadcrumbs::define('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Example: Users Index
Breadcrumbs::define('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

// Example: User Show
Breadcrumbs::define('users.show', function ($trail, $user) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.show', $user));
});

// Example: User Edit
Breadcrumbs::define('users.edit', function ($trail, $user) {
    $trail->parent('users.show', $user);
    $trail->push('Edit', route('users.edit', $user));
});
```

### 5. Load the Breadcrumb Configuration

In your `bootstrap/app.php` or a Service Provider, ensure the breadcrumb configuration is loaded:

```php
// In a Service Provider's boot method or bootstrap/app.php
require_once base_path('config/breadcrumbs.php');
```

## Usage Examples

### Basic Usage in Blade Templates

```blade
{{-- Auto-generate from current route --}}
<x-breadcrumbs />

{{-- Specify a specific route --}}
<x-breadcrumbs route="users.show" :params="[$user]" />
```

### Defining Breadcrumbs

#### Simple Breadcrumb
```php
Breadcrumbs::define('products', function ($trail) {
$trail->parent('dashboard');
$trail->push('Products', route('products.index'));
});
```

#### Breadcrumb with Parameters
```php
Breadcrumbs::define('products.show', function ($trail, $product) {
$trail->parent('products');
$trail->push($product->name, route('products.show', $product));
});
```

#### Breadcrumb without URL (current page)
```php
Breadcrumbs::define('products.create', function ($trail) {
$trail->parent('products');
$trail->push('Create Product', null); // null means no link
});
```

#### Nested Breadcrumbs
```php
Breadcrumbs::define('admin.users.roles.edit', function ($trail, $user, $role) {
$trail->parent('admin.users.show', $user);
$trail->push('Roles', route('admin.users.roles.index', $user));
$trail->push('Edit Role', route('admin.users.roles.edit', [$user, $role]));
});
```

## Advanced Features

### Conditional Breadcrumbs
```php
Breadcrumbs::define('orders.show', function ($trail, $order) {
$trail->parent('dashboard');

if (auth()->user()->can('view-all-orders')) {
$trail->push('All Orders', route('orders.index'));
} else {
$trail->push('My Orders', route('orders.my'));
}

$trail->push("Order #{$order->id}", route('orders.show', $order));
});
```

### Dynamic Titles
```php
Breadcrumbs::define('categories.show', function ($trail, $category) {
if ($category->parent) {
$trail->parent('categories.show', $category->parent);
} else {
$trail->parent('dashboard');
$trail->push('Categories', route('categories.index'));
}

$trail->push($category->name, route('categories.show', $category));
});
```

## Customization

### Styling the Component

The breadcrumb component can be customized by modifying the CSS classes in the Blade template. For Tailwind CSS users:

```blade
{{-- Custom styling --}}
<x-breadcrumbs class="bg-gray-50 px-4 py-2 rounded-md" />
```

### Using with UI Libraries

If using a UI library like Flux UI, replace the HTML structure in the component:

```blade
<flux:breadcrumbs class="text-sm font-medium">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && ! $loop->last)
            <flux:breadcrumbs.item href="{{ $breadcrumb->url }}">
                {{ $breadcrumb->title }}
            </flux:breadcrumbs.item>
        @else
            <flux:breadcrumbs.item>
                {{ $breadcrumb->title }}
            </flux:breadcrumbs.item>
        @endif
    @endforeach
</flux:breadcrumbs>
```

## Best Practices

1. **Always name your routes** - Breadcrumbs depend on named routes
2. **Define breadcrumbs hierarchically** - Use `parent()` to build logical navigation trees
3. **Keep titles concise** - Breadcrumbs should be scannable
4. **Use null URLs for current pages** - The last breadcrumb typically shouldn't be clickable
5. **Handle missing models gracefully** - Always check if models exist in breadcrumb definitions
6. **Group related breadcrumbs** - Organize definitions logically in the config file

## Testing

Test breadcrumbs by verifying the generated arrays:

```php
public function test_breadcrumbs_generation()
{
$user = User::factory()->create(['name' => 'John Doe']);

$breadcrumbs = Breadcrumbs::generate('users.show', $user);

$this->assertCount(3, $breadcrumbs);
$this->assertEquals('Dashboard', $breadcrumbs[0]->title);
$this->assertEquals('Users', $breadcrumbs[1]->title);
$this->assertEquals('John Doe', $breadcrumbs[2]->title);
}
```
