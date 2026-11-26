<?php

use ActTraining\LaravelBreadcrumbs\BreadcrumbsServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\VoltServiceProvider;

return [
    AppServiceProvider::class,
    VoltServiceProvider::class,
    BreadcrumbsServiceProvider::class,
];
