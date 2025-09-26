<?php

use ActTraining\LaravelBreadcrumbs\BreadcrumbGenerator;
use ActTraining\LaravelBreadcrumbs\Facades\Breadcrumbs;

beforeEach(function () {
    // Clear any existing breadcrumb definitions before each test
    $reflection = new ReflectionClass(\ActTraining\LaravelBreadcrumbs\Breadcrumbs::class);
    $property = $reflection->getProperty('breadcrumbs');
    $property->setAccessible(true);
    $property->setValue(null, []);
});

it('can define and generate simple breadcrumbs', function () {
    Breadcrumbs::define('dashboard', function ($trail) {
        $trail->push('Dashboard', '/dashboard');
    });

    $breadcrumbs = Breadcrumbs::generate('dashboard');

    expect($breadcrumbs)->toHaveCount(1);
    expect($breadcrumbs[0]->title)->toBe('Dashboard');
    expect($breadcrumbs[0]->url)->toBe('/dashboard');
});

it('can generate breadcrumbs with parent relationships', function () {
    Breadcrumbs::define('dashboard', function ($trail) {
        $trail->push('Dashboard', '/dashboard');
    });

    Breadcrumbs::define('users.index', function ($trail) {
        $trail->parent('dashboard');
        $trail->push('Users', '/users');
    });

    $breadcrumbs = Breadcrumbs::generate('users.index');

    expect($breadcrumbs)->toHaveCount(2);
    expect($breadcrumbs[0]->title)->toBe('Dashboard');
    expect($breadcrumbs[0]->url)->toBe('/dashboard');
    expect($breadcrumbs[1]->title)->toBe('Users');
    expect($breadcrumbs[1]->url)->toBe('/users');
});

it('can generate breadcrumbs with parameters', function () {
    $user = (object) ['id' => 1, 'name' => 'John Doe'];

    Breadcrumbs::define('dashboard', function ($trail) {
        $trail->push('Dashboard', '/dashboard');
    });

    Breadcrumbs::define('users.index', function ($trail) {
        $trail->parent('dashboard');
        $trail->push('Users', '/users');
    });

    Breadcrumbs::define('users.show', function ($trail, $user) {
        $trail->parent('users.index');
        $trail->push($user->name, "/users/{$user->id}");
    });

    $breadcrumbs = Breadcrumbs::generate('users.show', $user);

    expect($breadcrumbs)->toHaveCount(3);
    expect($breadcrumbs[0]->title)->toBe('Dashboard');
    expect($breadcrumbs[1]->title)->toBe('Users');
    expect($breadcrumbs[2]->title)->toBe('John Doe');
    expect($breadcrumbs[2]->url)->toBe('/users/1');
});

it('can generate breadcrumbs with null urls for current pages', function () {
    Breadcrumbs::define('dashboard', function ($trail) {
        $trail->push('Dashboard', '/dashboard');
    });

    Breadcrumbs::define('users.create', function ($trail) {
        $trail->parent('dashboard');
        $trail->push('Create User', null);
    });

    $breadcrumbs = Breadcrumbs::generate('users.create');

    expect($breadcrumbs)->toHaveCount(2);
    expect($breadcrumbs[0]->title)->toBe('Dashboard');
    expect($breadcrumbs[0]->url)->toBe('/dashboard');
    expect($breadcrumbs[1]->title)->toBe('Create User');
    expect($breadcrumbs[1]->url)->toBeNull();
});

it('returns empty array for undefined routes', function () {
    $breadcrumbs = Breadcrumbs::generate('undefined.route');

    expect($breadcrumbs)->toBeEmpty();
});

it('can generate breadcrumbs from current route', function () {
    // Mock a route for testing
    Route::get('/test', function () {
        return 'test';
    })->name('test.route');

    Breadcrumbs::define('test.route', function ($trail) {
        $trail->push('Test Page', '/test');
    });

    // Simulate a request to the named route
    $this->get('/test');

    $breadcrumbs = Breadcrumbs::generateFromRoute();

    expect($breadcrumbs)->toHaveCount(1);
    expect($breadcrumbs[0]->title)->toBe('Test Page');
    expect($breadcrumbs[0]->url)->toBe('/test');
});

it('returns empty array when no current route exists', function () {
    // Don't make any request, so there's no current route
    $breadcrumbs = Breadcrumbs::generateFromRoute();

    expect($breadcrumbs)->toBeEmpty();
});

it('can handle complex nested breadcrumbs', function () {
    $user = (object) ['id' => 1, 'name' => 'John Doe'];
    $role = (object) ['id' => 2, 'name' => 'Admin'];

    Breadcrumbs::define('dashboard', function ($trail) {
        $trail->push('Dashboard', '/dashboard');
    });

    Breadcrumbs::define('users.index', function ($trail) {
        $trail->parent('dashboard');
        $trail->push('Users', '/users');
    });

    Breadcrumbs::define('users.show', function ($trail, $user) {
        $trail->parent('users.index');
        $trail->push($user->name, "/users/{$user->id}");
    });

    Breadcrumbs::define('users.roles.edit', function ($trail, $user, $role) {
        $trail->parent('users.show', $user);
        $trail->push('Edit Role', "/users/{$user->id}/roles/{$role->id}/edit");
    });

    $breadcrumbs = Breadcrumbs::generate('users.roles.edit', $user, $role);

    expect($breadcrumbs)->toHaveCount(4);
    expect($breadcrumbs[0]->title)->toBe('Dashboard');
    expect($breadcrumbs[1]->title)->toBe('Users');
    expect($breadcrumbs[2]->title)->toBe('John Doe');
    expect($breadcrumbs[3]->title)->toBe('Edit Role');
    expect($breadcrumbs[3]->url)->toBe('/users/1/roles/2/edit');
});

describe('BreadcrumbGenerator', function () {
    it('can push breadcrumbs', function () {
        $generator = new BreadcrumbGenerator;

        $generator->push('Home', '/home');
        $generator->push('About', '/about');

        $breadcrumbs = $generator->getBreadcrumbs();

        expect($breadcrumbs)->toHaveCount(2);
        expect($breadcrumbs[0]->title)->toBe('Home');
        expect($breadcrumbs[0]->url)->toBe('/home');
        expect($breadcrumbs[1]->title)->toBe('About');
        expect($breadcrumbs[1]->url)->toBe('/about');
    });

    it('can push breadcrumbs without urls', function () {
        $generator = new BreadcrumbGenerator;

        $generator->push('Current Page', null);

        $breadcrumbs = $generator->getBreadcrumbs();

        expect($breadcrumbs)->toHaveCount(1);
        expect($breadcrumbs[0]->title)->toBe('Current Page');
        expect($breadcrumbs[0]->url)->toBeNull();
    });
});
