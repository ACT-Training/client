<?php

use App\Support\Breadcrumbs;

// Dashboard
Breadcrumbs::define('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Settings
Breadcrumbs::define('settings.profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Settings', null);
    $trail->push('Profile', null);
});

Breadcrumbs::define('settings.appearance', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Settings', null);
    $trail->push('Appearance', null);
});
