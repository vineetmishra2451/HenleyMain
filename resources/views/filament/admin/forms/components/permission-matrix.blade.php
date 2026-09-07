<div
    x-data="{
        state: $wire.entangle('{{ $getStatePath() }}'),
        allPermissions: @js(\Spatie\Permission\Models\Permission::pluck('name')->toArray()),
        selectAll() {
            this.state = [...this.allPermissions];
        },
        deselectAll() {
            this.state = [];
        },
        toggleRow(perms) {
            const hasAll = perms.every(p => this.state.includes(p));
            if (hasAll) {
                this.state = this.state.filter(p => !perms.includes(p));
            } else {
                const added = perms.filter(p => !this.state.includes(p));
                this.state = [...this.state, ...added];
            }
        },
        toggleColumn(abilityKey, matrixData) {
            const colPerms = [];
            for (const row of Object.values(matrixData)) {
                if (row[abilityKey]) colPerms.push(row[abilityKey]);
            }
            const hasAll = colPerms.every(p => this.state.includes(p));
            if (hasAll) {
                this.state = this.state.filter(p => !colPerms.includes(p));
            } else {
                const added = colPerms.filter(p => !this.state.includes(p));
                this.state = [...this.state, ...added];
            }
        }
    }"
    class="space-y-4 border border-gray-200 dark:border-gray-800 rounded-xl p-4 bg-white dark:bg-gray-900 shadow-sm"
>
    @php
        $matrix = [
            'Products' => [
                'icon' => 'heroicon-m-shopping-bag',
                'view' => 'products.view',
                'create' => 'products.create',
                'update' => 'products.update',
                'delete' => 'products.delete',
                'manage' => 'products.publish',
                'manage_label' => 'Publish',
            ],
            'Categories & Taxonomies' => [
                'icon' => 'heroicon-m-tag',
                'view' => null,
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'categories.manage',
                'manage_label' => 'Categories & Taxonomies',
                'extras' => ['taxonomies.manage'],
            ],
            'Brands' => [
                'icon' => 'heroicon-m-sparkles',
                'view' => null,
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'brands.manage',
                'manage_label' => 'Manage Brands',
            ],
            'Inventory & Stock' => [
                'icon' => 'heroicon-m-archive-box',
                'view' => 'inventory.view',
                'create' => null,
                'update' => 'inventory.update',
                'delete' => null,
                'manage' => 'inventory.adjust',
                'manage_label' => 'Stock Adjust',
            ],
            'Orders & Dispatch' => [
                'icon' => 'heroicon-m-shopping-cart',
                'view' => 'orders.view',
                'create' => 'orders.create',
                'update' => 'orders.update-status',
                'delete' => 'orders.cancel',
                'manage' => 'orders.view-own',
                'manage_label' => 'View Own Orders',
            ],
            'Shipments & Logistics' => [
                'icon' => 'heroicon-m-truck',
                'view' => 'shipments.view',
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'shipments.manage',
                'manage_label' => 'Manage Shipments',
            ],
            'Payments & Refunds' => [
                'icon' => 'heroicon-m-banknotes',
                'view' => 'payments.view',
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'refunds.process',
                'manage_label' => 'Process Refunds',
            ],
            'Coupons & Vouchers' => [
                'icon' => 'heroicon-m-ticket',
                'view' => 'coupons.view',
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'coupons.manage',
                'manage_label' => 'Manage Vouchers',
            ],
            'Partner Estates (Vendors)' => [
                'icon' => 'heroicon-m-building-storefront',
                'view' => 'vendors.view',
                'create' => null,
                'update' => 'vendors.manage',
                'delete' => null,
                'manage' => 'vendors.approve',
                'manage_label' => 'Approve Partners',
            ],
            'Customers & Connoisseurs' => [
                'icon' => 'heroicon-m-user-group',
                'view' => 'customers.view',
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'customers.manage',
                'manage_label' => 'Manage Connoisseurs',
            ],
            'Reviews & Sensory Notes' => [
                'icon' => 'heroicon-m-chat-bubble-left-right',
                'view' => 'reviews.view',
                'create' => 'reviews.create',
                'update' => null,
                'delete' => null,
                'manage' => 'reviews.moderate',
                'manage_label' => 'Moderate Reviews',
            ],
            'CMS, Journal & Banners' => [
                'icon' => 'heroicon-m-document-text',
                'view' => null,
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'cms.manage',
                'manage_label' => 'Editorial & Content',
                'extras' => ['journal.manage', 'banners.manage'],
            ],
            'Reports & Intelligence' => [
                'icon' => 'heroicon-m-chart-bar-square',
                'view' => 'reports.view',
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'analytics.view',
                'manage_label' => 'Executive Analytics',
            ],
            'Users & Roles' => [
                'icon' => 'heroicon-m-users',
                'view' => 'users.view',
                'create' => null,
                'update' => 'users.manage',
                'delete' => null,
                'manage' => 'roles.manage',
                'manage_label' => 'Manage Roles',
            ],
            'Platform Settings' => [
                'icon' => 'heroicon-m-cog-6-tooth',
                'view' => 'settings.view',
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'settings.manage',
                'manage_label' => 'Modify Settings',
            ],
            'Panel Access Gate' => [
                'icon' => 'heroicon-m-key',
                'view' => null,
                'create' => null,
                'update' => null,
                'delete' => null,
                'manage' => 'admin.access',
                'manage_label' => 'Admin Panel Access',
                'extras' => ['vendor.access'],
            ],
        ];
    @endphp

    <!-- Matrix Header & Quick Actions Toolbar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-3 border-b border-gray-200 dark:border-gray-800">
        <div>
            <h4 class="text-sm font-semibold text-gray-950 dark:text-white flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#4B1421] inline-block"></span>
                <span>2D Permission Matrix (Resources × Abilities)</span>
            </h4>
            <p class="text-xs text-gray-500 dark:text-gray-400">Granular access control mapped across catalogue, commerce, and security boundaries.</p>
        </div>

        <div class="flex items-center gap-2">
            <button
                type="button"
                @click="selectAll()"
                class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 dark:bg-emerald-950/40 dark:text-emerald-400 transition"
            >
                Select All
            </button>
            <button
                type="button"
                @click="deselectAll()"
                class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 dark:bg-rose-950/40 dark:text-rose-400 transition"
            >
                Clear All
            </button>
            <div class="text-xs font-mono px-2 py-1 rounded bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                <span x-text="state.length"></span> / {{ count(\Spatie\Permission\Models\Permission::all()) }} Active
            </div>
        </div>
    </div>

    <!-- 2D Table Matrix -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-gray-600 dark:text-gray-300 border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-800/80 text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-800">
                <tr>
                    <th scope="col" class="py-3 px-4 w-44">Resource Domain</th>
                    <th scope="col" class="py-3 px-3 text-center">
                        <button type="button" @click="toggleColumn('view', @js($matrix))" class="hover:text-[#4B1421] dark:hover:text-[#E6C687] font-semibold">
                            View / Read ↕
                        </button>
                    </th>
                    <th scope="col" class="py-3 px-3 text-center">
                        <button type="button" @click="toggleColumn('create', @js($matrix))" class="hover:text-[#4B1421] dark:hover:text-[#E6C687] font-semibold">
                            Create ↕
                        </button>
                    </th>
                    <th scope="col" class="py-3 px-3 text-center">
                        <button type="button" @click="toggleColumn('update', @js($matrix))" class="hover:text-[#4B1421] dark:hover:text-[#E6C687] font-semibold">
                            Edit / Update ↕
                        </button>
                    </th>
                    <th scope="col" class="py-3 px-3 text-center">
                        <button type="button" @click="toggleColumn('delete', @js($matrix))" class="hover:text-[#4B1421] dark:hover:text-[#E6C687] font-semibold">
                            Delete / Cancel ↕
                        </button>
                    </th>
                    <th scope="col" class="py-3 px-4 text-left">Manage & Special Abilities</th>
                    <th scope="col" class="py-3 px-3 text-center w-16">Row</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach($matrix as $domain => $row)
                    @php
                        $rowPerms = array_filter([
                            $row['view'] ?? null,
                            $row['create'] ?? null,
                            $row['update'] ?? null,
                            $row['delete'] ?? null,
                            $row['manage'] ?? null,
                            ...($row['extras'] ?? []),
                        ]);
                    @endphp
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/40 transition">
                        <!-- Resource Column -->
                        <td class="py-3 px-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold">{{ $domain }}</span>
                            </div>
                        </td>

                        <!-- View -->
                        <td class="py-3 px-3 text-center">
                            @if(!empty($row['view']))
                                <input
                                    type="checkbox"
                                    value="{{ $row['view'] }}"
                                    x-model="state"
                                    class="rounded border-gray-300 text-[#4B1421] shadow-sm focus:ring-[#4B1421] dark:border-gray-700 dark:bg-gray-800 cursor-pointer"
                                />
                            @else
                                <span class="text-gray-300 dark:text-gray-700">—</span>
                            @endif
                        </td>

                        <!-- Create -->
                        <td class="py-3 px-3 text-center">
                            @if(!empty($row['create']))
                                <input
                                    type="checkbox"
                                    value="{{ $row['create'] }}"
                                    x-model="state"
                                    class="rounded border-gray-300 text-[#4B1421] shadow-sm focus:ring-[#4B1421] dark:border-gray-700 dark:bg-gray-800 cursor-pointer"
                                />
                            @else
                                <span class="text-gray-300 dark:text-gray-700">—</span>
                            @endif
                        </td>

                        <!-- Update -->
                        <td class="py-3 px-3 text-center">
                            @if(!empty($row['update']))
                                <input
                                    type="checkbox"
                                    value="{{ $row['update'] }}"
                                    x-model="state"
                                    class="rounded border-gray-300 text-[#4B1421] shadow-sm focus:ring-[#4B1421] dark:border-gray-700 dark:bg-gray-800 cursor-pointer"
                                />
                            @else
                                <span class="text-gray-300 dark:text-gray-700">—</span>
                            @endif
                        </td>

                        <!-- Delete -->
                        <td class="py-3 px-3 text-center">
                            @if(!empty($row['delete']))
                                <input
                                    type="checkbox"
                                    value="{{ $row['delete'] }}"
                                    x-model="state"
                                    class="rounded border-gray-300 text-[#4B1421] shadow-sm focus:ring-[#4B1421] dark:border-gray-700 dark:bg-gray-800 cursor-pointer"
                                />
                            @else
                                <span class="text-gray-300 dark:text-gray-700">—</span>
                            @endif
                        </td>

                        <!-- Manage / Special -->
                        <td class="py-3 px-4">
                            <div class="flex flex-wrap items-center gap-2">
                                @if(!empty($row['manage']))
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs">
                                        <input
                                            type="checkbox"
                                            value="{{ $row['manage'] }}"
                                            x-model="state"
                                            class="rounded border-gray-300 text-[#4B1421] shadow-sm focus:ring-[#4B1421] dark:border-gray-700 dark:bg-gray-800"
                                        />
                                        <span class="text-gray-700 dark:text-gray-300 font-mono text-[11px]">{{ $row['manage_label'] ?? $row['manage'] }}</span>
                                    </label>
                                @endif

                                @if(!empty($row['extras']))
                                    @foreach($row['extras'] as $extra)
                                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs">
                                            <input
                                                type="checkbox"
                                                value="{{ $extra }}"
                                                x-model="state"
                                                class="rounded border-gray-300 text-[#4B1421] shadow-sm focus:ring-[#4B1421] dark:border-gray-700 dark:bg-gray-800"
                                            />
                                            <span class="text-gray-700 dark:text-gray-300 font-mono text-[11px]">{{ $extra }}</span>
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </td>

                        <!-- Row Toggle -->
                        <td class="py-3 px-3 text-center">
                            <button
                                type="button"
                                @click="toggleRow(@js(array_values($rowPerms)))"
                                class="text-[10px] px-1.5 py-0.5 rounded border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 font-semibold text-gray-600 dark:text-gray-400"
                                title="Toggle all in this row"
                            >
                                Row
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
