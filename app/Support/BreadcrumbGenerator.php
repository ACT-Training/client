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
