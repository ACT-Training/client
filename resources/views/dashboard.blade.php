<x-layouts.app :title="__('Dashboard')">
    <div class="p-3">
        <div class="mb-6">
            <flux:heading size="xl">Dashboard</flux:heading>
            <flux:subheading size="lg">Welcome back, {{ auth()->user()->name }}</flux:subheading>
        </div>

        <!-- Stats Cards -->
        <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <flux:card class="overflow-hidden p-0">
                <div class="p-4">
                    <flux:text size="sm" variant="muted">Total Learners</flux:text>
                    <flux:heading size="xl" class="mt-2 tabular-nums">3,543</flux:heading>
                    <div class="mt-2 flex items-center gap-1">
                        <flux:badge variant="outline" color="green" size="xs">+12%</flux:badge>
                        <flux:text size="xs" variant="muted">from last month</flux:text>
                    </div>
                </div>
                <flux:chart class="h-12" :value="[120, 132, 101, 134, 90, 230, 210, 150, 180, 200, 220, 180]">
                    <flux:chart.svg gutter="0">
                        <flux:chart.line class="text-blue-500" />
                        <flux:chart.area class="text-blue-100 dark:text-blue-400/30" />
                    </flux:chart.svg>
                </flux:chart>
            </flux:card>

            <flux:card class="overflow-hidden p-0">
                <div class="p-4">
                    <flux:text size="sm" variant="muted">Sign Ups</flux:text>
                    <flux:heading size="xl" class="mt-2 tabular-nums">452</flux:heading>
                    <div class="mt-2 flex items-center gap-1">
                        <flux:badge variant="outline" color="green" size="xs">+20%</flux:badge>
                        <flux:text size="xs" variant="muted">from last month</flux:text>
                    </div>
                </div>
                <flux:chart class="h-12" :value="[15, 18, 16, 19, 22, 25, 28, 25, 29, 28, 32, 35]">
                    <flux:chart.svg gutter="0">
                        <flux:chart.line class="text-green-500" />
                        <flux:chart.area class="text-green-100 dark:text-green-400/30" />
                    </flux:chart.svg>
                </flux:chart>
            </flux:card>

            <flux:card class="overflow-hidden p-0">
                <div class="p-4">
                    <flux:text size="sm" variant="muted">Enquiries</flux:text>
                    <flux:heading size="xl" class="mt-2 tabular-nums">1,234</flux:heading>
                    <div class="mt-2 flex items-center gap-1">
                        <flux:badge variant="outline" color="green" size="xs">+5%</flux:badge>
                        <flux:text size="xs" variant="muted">from last month</flux:text>
                    </div>
                </div>
                <flux:chart class="h-12" :value="[45, 52, 38, 44, 50, 49, 60, 70, 91, 125, 102, 89]">
                    <flux:chart.svg gutter="0">
                        <flux:chart.line class="text-amber-500" />
                        <flux:chart.area class="text-amber-100 dark:text-amber-400/30" />
                    </flux:chart.svg>
                </flux:chart>
            </flux:card>

            <flux:card class="overflow-hidden p-0">
                <div class="p-4">
                    <flux:text size="sm" variant="muted">Conversion</flux:text>
                    <flux:heading size="xl" class="mt-2 tabular-nums">3.24%</flux:heading>
                    <div class="mt-2 flex items-center gap-1">
                        <flux:badge variant="outline" color="red" size="xs">-2%</flux:badge>
                        <flux:text size="xs" variant="muted">from last month</flux:text>
                    </div>
                </div>
                <flux:chart class="h-12" :value="[8.2, 7.1, 6.8, 5.4, 4.2, 3.8, 2.9, 3.1, 3.4, 3.6, 3.2, 3.24]">
                    <flux:chart.svg gutter="0">
                        <flux:chart.line class="text-purple-500" />
                        <flux:chart.area class="text-purple-100 dark:text-purple-400/30" />
                    </flux:chart.svg>
                </flux:chart>
            </flux:card>
        </div>

        <!-- Main Content Grid -->
        <div class="grid gap-4 lg:grid-cols-3">
            <!-- Chart Card -->
            <flux:card class="lg:col-span-2">
                <div class="p-4">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <flux:heading size="md">Revenue Overview</flux:heading>
                            <flux:text size="sm" variant="muted">Monthly revenue for the last 6 months</flux:text>
                        </div>
                        <flux:button size="sm" variant="ghost">View all</flux:button>
                    </div>
                    <flux:chart
                        class="h-80"
                        :value="[
                        ['date' => '2024-07-01', 'revenue' => 12000],
                        ['date' => '2024-08-01', 'revenue' => 16000],
                        ['date' => '2024-09-01', 'revenue' => 48000],
                        ['date' => '2024-10-01', 'revenue' => 61000],
                        ['date' => '2024-11-01', 'revenue' => 58000],
                        ['date' => '2024-12-01', 'revenue' => 67000]
                    ]"
                    >
                        <flux:chart.svg>
                            <flux:chart.line field="revenue" class="text-blue-500 dark:text-blue-400" />
                            <flux:chart.area field="revenue" class="text-blue-100 dark:text-blue-400/20" />

                            <flux:chart.axis axis="x" field="date">
                                <flux:chart.axis.tick />
                                <flux:chart.axis.line />
                            </flux:chart.axis>

                            <flux:chart.axis axis="y" :format="['style' => 'currency', 'currency' => 'GBP']">
                                <flux:chart.axis.grid />
                                <flux:chart.axis.tick />
                            </flux:chart.axis>

                            <flux:chart.cursor />
                        </flux:chart.svg>

                        <flux:chart.tooltip>
                            <flux:chart.tooltip.heading
                                field="date"
                                :format="['year' => 'numeric', 'month' => 'long']"
                            />
                            <flux:chart.tooltip.value
                                field="revenue"
                                label="Revenue"
                                :format="['style' => 'currency', 'currency' => 'USD']"
                            />
                        </flux:chart.tooltip>
                    </flux:chart>
                </div>
            </flux:card>

            <!-- Recent Activity -->
            <flux:card>
                <div class="p-4">
                    <flux:heading size="md" class="mb-4">Recent Activity</flux:heading>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <flux:badge size="sm" color="green" class="rounded-full p-1.5">
                                <flux:icon.check class="h-3 w-3" />
                            </flux:badge>
                            <div class="min-w-0 flex-1">
                                <flux:text size="sm" class="font-medium">New enquiry received</flux:text>
                                <flux:text size="xs" variant="muted">2 minutes ago</flux:text>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <flux:badge size="sm" color="blue" class="rounded-full p-1.5">
                                <flux:icon.user-plus class="h-3 w-3" />
                            </flux:badge>
                            <div class="min-w-0 flex-1">
                                <flux:text size="sm" class="font-medium">New learner registered</flux:text>
                                <flux:text size="xs" variant="muted">5 minutes ago</flux:text>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <flux:badge size="sm" color="amber" class="rounded-full p-1.5">
                                <flux:icon.exclamation-triangle class="h-3 w-3" />
                            </flux:badge>
                            <div class="min-w-0 flex-1">
                                <flux:text size="sm" class="font-medium">Server maintenance scheduled</flux:text>
                                <flux:text size="xs" variant="muted">1 hour ago</flux:text>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <flux:badge size="sm" color="purple" class="rounded-full p-1.5">
                                <flux:icon.bell class="h-3 w-3" />
                            </flux:badge>
                            <div class="min-w-0 flex-1">
                                <flux:text size="sm" class="font-medium">System notification sent</flux:text>
                                <flux:text size="xs" variant="muted">3 hours ago</flux:text>
                            </div>
                        </div>
                    </div>
                </div>
            </flux:card>
        </div>

        <!-- Bottom Grid -->
        <div class="mt-6 grid gap-4 lg:grid-cols-2">
            <!-- Top Employers -->
            <flux:card>
                <div class="p-4">
                    <flux:heading size="md" class="mb-4">Top Employers</flux:heading>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <flux:avatar size="sm" name="Tech Solutions Ltd" color="auto" />
                                <flux:text size="sm" class="font-medium">Tech Solutions Ltd</flux:text>
                            </div>
                            <flux:badge color="blue" size="sm">56 learners</flux:badge>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <flux:avatar size="sm" name="Innovation Corp" color="auto" />
                                <flux:text size="sm" class="font-medium">Innovation Corp</flux:text>
                            </div>
                            <flux:badge color="blue" size="sm">37 learners</flux:badge>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <flux:avatar size="sm" name="Global Systems" color="auto" />
                                <flux:text size="sm" class="font-medium">Global Systems</flux:text>
                            </div>
                            <flux:badge color="blue" size="sm">29 learners</flux:badge>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <flux:avatar size="sm" name="Digital Media Inc" color="auto" />
                                <flux:text size="sm" class="font-medium">Digital Media Inc</flux:text>
                            </div>
                            <flux:badge color="blue" size="sm">16 learners</flux:badge>
                        </div>
                    </div>
                </div>
            </flux:card>

            <!-- Quick Actions -->
            <flux:card>
                <div class="p-4">
                    <flux:heading size="md" class="mb-4">Quick Actions</flux:heading>
                    <div class="grid grid-cols-2 gap-3">
                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.user-plus class="mb-2 h-5 w-5" />
                            <flux:text size="xs">Add Learner</flux:text>
                        </flux:button>

                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.academic-cap class="mb-2 h-5 w-5" />
                            <flux:text size="xs">New Course</flux:text>
                        </flux:button>

                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.chart-bar class="mb-2 h-5 w-5" />
                            <flux:text size="xs">View Reports</flux:text>
                        </flux:button>

                        <flux:button variant="outline" class="h-20 flex-col">
                            <flux:icon.message-circle-question-mark class="mb-2 h-5 w-5" />
                            <flux:text size="xs">Enquiries</flux:text>
                        </flux:button>
                    </div>
                </div>
            </flux:card>
        </div>
    </div>
</x-layouts.app>
