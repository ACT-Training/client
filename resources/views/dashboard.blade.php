<x-layouts.app :title="__('Dashboard')">
    <div class="p-6">
        <div class="mb-6">
            <flux:heading size="lg">Dashboard</flux:heading>
            <flux:text class="text-zinc-400">Welcome back, {{ auth()->user()->name }}</flux:text>
        </div>

        <!-- Stats Cards -->
        <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-sm font-medium text-zinc-400">Total Users</flux:text>
                        <flux:heading size="lg" class="text-2xl font-bold">2,543</flux:heading>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                        <flux:icon.users class="h-4 w-4 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <flux:text class="text-xs text-green-600">+12%</flux:text>
                    <flux:text class="ml-1 text-xs text-zinc-400">from last month</flux:text>
                </div>
            </flux:card>

            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-sm font-medium text-zinc-400">Revenue</flux:text>
                        <flux:heading size="lg" class="text-2xl font-bold">$45,231</flux:heading>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                        <flux:icon.currency-dollar class="h-4 w-4 text-green-600 dark:text-green-400" />
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <flux:text class="text-xs text-green-600">+20%</flux:text>
                    <flux:text class="ml-1 text-xs text-zinc-400">from last month</flux:text>
                </div>
            </flux:card>

            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-sm font-medium text-zinc-400">Orders</flux:text>
                        <flux:heading size="lg" class="text-2xl font-bold">1,234</flux:heading>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900">
                        <flux:icon.shopping-bag class="h-4 w-4 text-orange-600 dark:text-orange-400" />
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <flux:text class="text-xs text-green-600">+5%</flux:text>
                    <flux:text class="ml-1 text-xs text-zinc-400">from last month</flux:text>
                </div>
            </flux:card>

            <flux:card class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:text class="text-sm font-medium text-zinc-400">Conversion</flux:text>
                        <flux:heading size="lg" class="text-2xl font-bold">3.24%</flux:heading>
                    </div>
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900">
                        <flux:icon.chart-bar class="h-4 w-4 text-purple-600 dark:text-purple-400" />
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <flux:text class="text-xs text-red-600">-2%</flux:text>
                    <flux:text class="ml-1 text-xs text-zinc-400">from last month</flux:text>
                </div>
            </flux:card>
        </div>

        <!-- Main Content Grid -->
        <div class="grid gap-4 lg:grid-cols-3">
            <!-- Chart Card -->
            <flux:card class="lg:col-span-2">
                <div class="p-6">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <flux:heading size="md">Revenue Overview</flux:heading>
                            <flux:text class="text-sm text-zinc-400">Monthly revenue for the last 6 months</flux:text>
                        </div>
                        <flux:button size="sm" variant="ghost">View all</flux:button>
                    </div>
                    <div class="flex h-80 items-center justify-center rounded-lg bg-zinc-50 dark:bg-zinc-800">
                        <flux:text class="text-zinc-400">Chart visualization would go here</flux:text>
                    </div>
                </div>
            </flux:card>

            <!-- Recent Activity -->
            <flux:card>
                <div class="p-6">
                    <flux:heading size="md" class="mb-4">Recent Activity</flux:heading>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-900"
                            >
                                <flux:icon.check class="h-4 w-4 text-green-600 dark:text-green-400" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <flux:text class="text-sm font-medium">New order placed</flux:text>
                                <flux:text class="text-xs text-zinc-400">2 minutes ago</flux:text>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900"
                            >
                                <flux:icon.user-plus class="h-4 w-4 text-blue-600 dark:text-blue-400" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <flux:text class="text-sm font-medium">New user registered</flux:text>
                                <flux:text class="text-xs text-zinc-400">5 minutes ago</flux:text>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900"
                            >
                                <flux:icon.exclamation-triangle class="h-4 w-4 text-orange-600 dark:text-orange-400" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <flux:text class="text-sm font-medium">Server maintenance</flux:text>
                                <flux:text class="text-xs text-zinc-400">1 hour ago</flux:text>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900"
                            >
                                <flux:icon.bell class="h-4 w-4 text-purple-600 dark:text-purple-400" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <flux:text class="text-sm font-medium">New notification</flux:text>
                                <flux:text class="text-xs text-zinc-400">3 hours ago</flux:text>
                            </div>
                        </div>
                    </div>
                </div>
            </flux:card>
        </div>

        <!-- Bottom Grid -->
        <div class="mt-6 grid gap-4 lg:grid-cols-2">
            <!-- Top Products -->
            <flux:card>
                <div class="p-6">
                    <flux:heading size="md" class="mb-4">Top Products</flux:heading>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded bg-zinc-100 dark:bg-zinc-800"></div>
                                <flux:text class="text-sm font-medium">Product A</flux:text>
                            </div>
                            <flux:text class="text-sm text-zinc-400">$1,234</flux:text>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded bg-zinc-100 dark:bg-zinc-800"></div>
                                <flux:text class="text-sm font-medium">Product B</flux:text>
                            </div>
                            <flux:text class="text-sm text-zinc-400">$987</flux:text>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="h-8 w-8 rounded bg-zinc-100 dark:bg-zinc-800"></div>
                                <flux:text class="text-sm font-medium">Product C</flux:text>
                            </div>
                            <flux:text class="text-sm text-zinc-400">$756</flux:text>
                        </div>
                    </div>
                </div>
            </flux:card>

            <!-- Quick Actions -->
            <flux:card>
                <div class="p-6">
                    <flux:heading size="md" class="mb-4">Quick Actions</flux:heading>
                    <div class="grid grid-cols-2 gap-3">
                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.user-plus class="mb-2 h-5 w-5" />
                            <flux:text class="text-xs">Add User</flux:text>
                        </flux:button>

                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.shopping-bag class="mb-2 h-5 w-5" />
                            <flux:text class="text-xs">New Order</flux:text>
                        </flux:button>

                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.chart-bar class="mb-2 h-5 w-5" />
                            <flux:text class="text-xs">View Reports</flux:text>
                        </flux:button>

                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.cog class="mb-2 h-5 w-5" />
                            <flux:text class="text-xs">Settings</flux:text>
                        </flux:button>
                    </div>
                </div>
            </flux:card>
        </div>
    </div>
</x-layouts.app>
