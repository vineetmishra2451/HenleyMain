<x-filament-widgets::widget>
    <x-filament::section
        icon="heroicon-o-chart-bar-square"
    >
        <x-slot name="heading">
            <div class="flex items-center gap-x-2">
                <span class="text-base font-semibold text-gray-950 dark:text-white">Executive & Financial Reports</span>
                <x-filament::badge color="primary" size="sm">Reports Hub</x-filament::badge>
            </div>
        </x-slot>

        <x-slot name="description">
            Direct access to consolidated multi-vendor accounting, inventory depletion velocity, and tax audit reporting.
        </x-slot>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-top: 1rem;">
            <!-- Card 1: Sales Analytics -->
            <a href="/reports/sales" class="group transition duration-150 hover:shadow-md" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: 0.5rem; padding: 1rem; border: 1px solid rgba(156, 163, 175, 0.2); background: rgba(249, 250, 251, 0.05); text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="border-radius: 0.5rem; padding: 0.5rem; background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <x-heroicon-o-presentation-chart-line style="width: 20px; height: 20px;" />
                    </div>
                    <span style="font-size: 0.75rem; font-weight: 600; color: #9ca3af;">View →</span>
                </div>
                <div style="margin-top: 0.75rem;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: currentColor;">Sales & Revenue</h4>
                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #9ca3af;">Gross/net margin analysis, order velocity, and promo coupon performance.</p>
                </div>
            </a>

            <!-- Card 2: Inventory Valuation -->
            <a href="/reports/inventory" class="group transition duration-150 hover:shadow-md" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: 0.5rem; padding: 1rem; border: 1px solid rgba(156, 163, 175, 0.2); background: rgba(249, 250, 251, 0.05); text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="border-radius: 0.5rem; padding: 0.5rem; background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <x-heroicon-o-archive-box style="width: 20px; height: 20px;" />
                    </div>
                    <span style="font-size: 0.75rem; font-weight: 600; color: #9ca3af;">View →</span>
                </div>
                <div style="margin-top: 0.75rem;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: currentColor;">Inventory Valuation</h4>
                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #9ca3af;">Warehouse stock valuation, SKU turnover, and batch reorder forecasting.</p>
                </div>
            </a>

            <!-- Card 3: Vendor Settlement -->
            <a href="/reports/vendors" class="group transition duration-150 hover:shadow-md" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: 0.5rem; padding: 1rem; border: 1px solid rgba(156, 163, 175, 0.2); background: rgba(249, 250, 251, 0.05); text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="border-radius: 0.5rem; padding: 0.5rem; background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                        <x-heroicon-o-building-storefront style="width: 20px; height: 20px;" />
                    </div>
                    <span style="font-size: 0.75rem; font-weight: 600; color: #9ca3af;">View →</span>
                </div>
                <div style="margin-top: 0.75rem;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: currentColor;">Vendor Settlement</h4>
                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #9ca3af;">Partner estate commission splits, payout reconciliations, and ledgers.</p>
                </div>
            </a>

            <!-- Card 4: Tax & Compliance -->
            <a href="/reports/tax" class="group transition duration-150 hover:shadow-md" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: 0.5rem; padding: 1rem; border: 1px solid rgba(156, 163, 175, 0.2); background: rgba(249, 250, 251, 0.05); text-decoration: none;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="border-radius: 0.5rem; padding: 0.5rem; background: rgba(168, 85, 247, 0.1); color: #a855f7;">
                        <x-heroicon-o-document-text style="width: 20px; height: 20px;" />
                    </div>
                    <span style="font-size: 0.75rem; font-weight: 600; color: #9ca3af;">View →</span>
                </div>
                <div style="margin-top: 0.75rem;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: currentColor;">Tax & GST Ledger</h4>
                    <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #9ca3af;">State-wise GST filings, HSN code breakdowns, and export invoices.</p>
                </div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
