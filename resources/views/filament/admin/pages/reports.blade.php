<x-filament-panels::page>
    <!-- Top Filter & Selection Bar -->
    <div class="space-y-6">
        <!-- Report Type Switcher Tabs -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-2 shadow-sm">
            <div class="flex items-center justify-between flex-wrap gap-2">
                <nav class="flex items-center space-x-1 sm:space-x-2 overflow-x-auto py-1" aria-label="Report Categories">
                    @php
                        $reports = [
                            'sales' => ['label' => 'Sales Analytics', 'icon' => 'heroicon-m-presentation-chart-line'],
                            'revenue' => ['label' => 'Revenue & Margin', 'icon' => 'heroicon-m-currency-rupee'],
                            'product' => ['label' => 'Product & Terroir', 'icon' => 'heroicon-m-shopping-bag'],
                            'inventory' => ['label' => 'Inventory Valuation', 'icon' => 'heroicon-m-archive-box'],
                            'customer' => ['label' => 'Customer & LTV', 'icon' => 'heroicon-m-user-group'],
                            'vendor' => ['label' => 'Vendor Settlement', 'icon' => 'heroicon-m-building-storefront'],
                            'order' => ['label' => 'Order Velocity', 'icon' => 'heroicon-m-truck'],
                        ];
                    @endphp

                    @foreach($reports as $key => $meta)
                        <button
                            wire:click="setReport('{{ $key }}')"
                            type="button"
                            class="inline-flex items-center gap-x-2 px-3 py-2 text-xs sm:text-sm font-medium rounded-lg transition-colors whitespace-nowrap {{ $activeReport === $key ? 'bg-[#4B1421] text-white shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' }}"
                        >
                            @if($key === 'sales')
                                <x-heroicon-m-presentation-chart-line style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @elseif($key === 'revenue')
                                <x-heroicon-m-banknotes style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @elseif($key === 'product')
                                <x-heroicon-m-shopping-bag style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @elseif($key === 'inventory')
                                <x-heroicon-m-archive-box style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @elseif($key === 'customer')
                                <x-heroicon-m-user-group style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @elseif($key === 'vendor')
                                <x-heroicon-m-building-storefront style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @else
                                <x-heroicon-m-truck style="width: 16px; height: 16px; flex-shrink: 0;" />
                            @endif
                            <span>{{ $meta['label'] }}</span>
                        </button>
                    @endforeach
                </nav>

                <!-- Action Button -->
                <div class="flex items-center gap-2">
                    <button
                        wire:click="exportReport"
                        type="button"
                        class="inline-flex items-center gap-x-1.5 px-3 py-2 text-xs font-semibold rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                    >
                        <x-heroicon-m-arrow-down-tray style="width: 16px; height: 16px; flex-shrink: 0;" class="text-gray-500" />
                        <span>Export CSV</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Date Range Filter Bar -->
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-4 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Date Range:</span>
                <div class="inline-flex rounded-lg border border-gray-200 dark:border-gray-700 p-0.5 bg-gray-50 dark:bg-gray-800">
                    @foreach(['7d' => 'Last 7 Days', '30d' => 'Last 30 Days', '90d' => 'Last Quarter', '1y' => 'Past Year'] as $rangeKey => $rangeLabel)
                        <button
                            wire:click="setRange('{{ $rangeKey }}')"
                            type="button"
                            class="px-2.5 py-1 text-xs font-medium rounded-md transition {{ $dateRange === $rangeKey ? 'bg-white dark:bg-gray-900 text-[#4B1421] dark:text-[#E6C687] font-semibold shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}"
                        >
                            {{ $rangeLabel }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                <x-heroicon-m-calendar-days style="width: 16px; height: 16px; flex-shrink: 0;" class="text-gray-400" />
                <span>Auditing interval: <strong class="text-gray-800 dark:text-gray-200">{{ $startDate }}</strong> through <strong class="text-gray-800 dark:text-gray-200">{{ $endDate }}</strong></span>
            </div>
        </div>

        <!-- 4 Executive KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($this->getReportKpis() as $kpi)
                <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 shadow-sm hover:border-[#4B1421]/40 transition">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ $kpi['label'] }}</span>
                        @if($kpi['trend'] === 'up')
                            <span class="inline-flex items-center gap-x-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400">
                                <x-heroicon-m-arrow-trending-up style="width: 14px; height: 14px; flex-shrink: 0;" />
                                {{ $kpi['change'] }}
                            </span>
                        @elseif($kpi['trend'] === 'down')
                            <span class="inline-flex items-center gap-x-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400">
                                <x-heroicon-m-arrow-trending-down style="width: 14px; height: 14px; flex-shrink: 0;" />
                                {{ $kpi['change'] }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-400">
                                {{ $kpi['change'] }}
                            </span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <div class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white font-serif">{{ $kpi['value'] }}</div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $kpi['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Trend Chart Section -->
        @php
            $chartData = $this->getChartData();
            $maxVal = max($chartData['datasets'][0]['data']);
        @endphp
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ ucfirst($activeReport) }} Velocity Trend ({{ strtoupper($dateRange) }})
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Comparing current interval vs prior matched period.</p>
                </div>
                <div class="flex items-center gap-4 text-xs font-medium">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-[#4B1421] inline-block"></span>
                        <span class="text-gray-700 dark:text-gray-300">Current Period</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-0.5 border-b-2 border-dashed border-gray-400 inline-block"></span>
                        <span class="text-gray-500">Prior Period Baseline</span>
                    </div>
                </div>
            </div>

            <!-- Visual Bar/Area Representation -->
            <div class="pt-6 pb-2">
                <div class="h-48 w-full flex items-end gap-1 sm:gap-2">
                    @foreach($chartData['datasets'][0]['data'] as $idx => $val)
                        @php
                            $pct = $maxVal > 0 ? ($val / $maxVal) * 100 : 0;
                            $lbl = $chartData['labels'][$idx] ?? '';
                        @endphp
                        <div class="flex-1 flex flex-col items-center gap-1 group relative">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity absolute -top-8 bg-gray-900 text-white text-[10px] px-2 py-0.5 rounded shadow whitespace-nowrap z-10">
                                {{ $lbl }}: {{ is_numeric($val) ? number_format($val) : $val }}
                            </div>
                            <div class="w-full bg-[#4B1421]/15 dark:bg-[#4B1421]/30 rounded-t group-hover:bg-[#4B1421] transition-colors" style="height: {{ max(8, $pct) }}%;"></div>
                            <span class="text-[9px] text-gray-400 truncate w-full text-center hidden sm:block">{{ $lbl }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Summary Data Table -->
        @php
            $tableData = $this->getTableData();
        @endphp
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Detailed {{ ucfirst($activeReport) }} Breakdown</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Reconciled line items for executive verification and ledger settlement.</p>
                </div>
                <span class="text-xs px-2.5 py-1 rounded-full bg-[#4B1421]/10 text-[#4B1421] dark:text-[#E6C687] font-medium font-mono">
                    {{ count($tableData['rows']) }} Records
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-800/60 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-800">
                        <tr>
                            @foreach($tableData['headers'] as $header)
                                <th scope="col" class="px-6 py-3.5 whitespace-nowrap">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($tableData['rows'] as $row)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition">
                                @foreach($row as $cellIdx => $cell)
                                    <td class="px-6 py-4 whitespace-nowrap {{ $cellIdx === 0 ? 'font-medium text-gray-900 dark:text-white' : '' }}">
                                        @if(str_starts_with($cell, '₹'))
                                            <span class="font-mono font-semibold">{{ $cell }}</span>
                                        @elseif(str_ends_with($cell, '%'))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400">
                                                {{ $cell }}
                                            </span>
                                        @elseif(str_contains($cell, 'Low Stock'))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400">
                                                {{ $cell }}
                                            </span>
                                        @elseif(str_contains($cell, 'Optimal') || str_contains($cell, 'Adequate') || str_contains($cell, 'On-Track') || str_contains($cell, 'Resolved'))
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400">
                                                {{ $cell }}
                                            </span>
                                        @else
                                            {{ $cell }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
