@php
    $metrics = $this->getFinancialMetrics();
@endphp

<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <!-- Date range toggle -->
        <x-filament::section>
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af;">Analysis Interval:</span>
                    <div style="display: inline-flex; border-radius: 0.5rem; padding: 0.25rem; gap: 0.25rem; background: rgba(156, 163, 175, 0.1);">
                        @foreach (['7d' => '7 Days', '30d' => '30 Days', '90d' => 'Quarter', '1y' => '1 Year'] as $key => $label)
                            <button
                                wire:click="setRange('{{ $key }}')"
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 0.375rem; border: none; cursor: pointer; transition: all 0.15s; {{ $this->dateRange === $key ? 'background: #4B1421; color: #ffffff;' : 'background: transparent; color: inherit;' }}"
                            >
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div style="font-size: 0.75rem; color: #9ca3af;">
                    <span>Direct bank disbursements on the 1st & 15th of each calendar month.</span>
                </div>
            </div>
        </x-filament::section>

        <!-- 4 Metric Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Gross Merchandise Value</p>
                <p style="font-size: 1.75rem; font-weight: 700; font-family: serif; color: currentColor; margin: 0.25rem 0 0 0;">₹{{ number_format($metrics['gross']) }}</p>
                <p style="font-size: 0.75rem; color: #10b981; font-weight: 500; margin: 0.5rem 0 0 0;">↑ +14.2% vs previous period</p>
            </x-filament::section>

            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Platform Commission</p>
                <p style="font-size: 1.75rem; font-weight: 700; font-family: serif; color: #f43f5e; margin: 0.25rem 0 0 0;">₹{{ number_format($metrics['commission']) }}</p>
                <p style="font-size: 0.75rem; color: #9ca3af; margin: 0.5rem 0 0 0;">15.0% contract curation fee</p>
            </x-filament::section>

            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Net Estate Payout</p>
                <p style="font-size: 1.75rem; font-weight: 700; font-family: serif; color: #4B1421; margin: 0.25rem 0 0 0;">₹{{ number_format($metrics['net']) }}</p>
                <p style="font-size: 0.75rem; color: #10b981; font-weight: 500; margin: 0.5rem 0 0 0;">Auto-disbursed to verified account</p>
            </x-filament::section>

            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Allocated Orders</p>
                <p style="font-size: 1.75rem; font-weight: 700; font-family: serif; color: currentColor; margin: 0.25rem 0 0 0;">{{ $metrics['orders'] }} Orders</p>
                <p style="font-size: 0.75rem; color: #9ca3af; margin: 0.5rem 0 0 0;">Avg: ₹{{ number_format($metrics['avg_order']) }} / order</p>
            </x-filament::section>
        </div>

        <!-- Bi-weekly Settlement History -->
        <x-filament::section>
            <x-slot name="heading">
                Recent Settlement Dispatches
            </x-slot>

            <x-slot name="description">
                Bi-weekly bank NEFT / RTGS transfers for fulfilled orders.
            </x-slot>

            <div style="overflow-x: auto; margin-top: 1rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(156, 163, 175, 0.2); font-size: 0.75rem; text-transform: uppercase; color: #9ca3af;">
                            <th style="padding: 0.75rem 1rem;">Settlement Cycle</th>
                            <th style="padding: 0.75rem 1rem;">Orders</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Gross Sales</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Commission (15%)</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Net Payout</th>
                            <th style="padding: 0.75rem 1rem; text-align: center;">Status</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid rgba(156, 163, 175, 0.1);">
                            <td style="padding: 0.875rem 1rem; font-weight: 500;">Cycle 16 (16 Aug – 31 Aug 2026)</td>
                            <td style="padding: 0.875rem 1rem; color: #9ca3af;">24 orders</td>
                            <td style="padding: 0.875rem 1rem; text-align: right;">₹278,400</td>
                            <td style="padding: 0.875rem 1rem; text-align: right; color: #f43f5e;">-₹41,760</td>
                            <td style="padding: 0.875rem 1rem; text-align: right; font-weight: 700;">₹236,640</td>
                            <td style="padding: 0.875rem 1rem; text-align: center;">
                                <x-filament::badge color="success" size="sm">Settled</x-filament::badge>
                            </td>
                            <td style="padding: 0.875rem 1rem; text-align: right; font-family: monospace; font-size: 0.75rem; color: #9ca3af;">NEFT-20260901-8841</td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(156, 163, 175, 0.1);">
                            <td style="padding: 0.875rem 1rem; font-weight: 500;">Cycle 15 (01 Aug – 15 Aug 2026)</td>
                            <td style="padding: 0.875rem 1rem; color: #9ca3af;">18 orders</td>
                            <td style="padding: 0.875rem 1rem; text-align: right;">₹204,100</td>
                            <td style="padding: 0.875rem 1rem; text-align: right; color: #f43f5e;">-₹30,615</td>
                            <td style="padding: 0.875rem 1rem; text-align: right; font-weight: 700;">₹173,485</td>
                            <td style="padding: 0.875rem 1rem; text-align: center;">
                                <x-filament::badge color="success" size="sm">Settled</x-filament::badge>
                            </td>
                            <td style="padding: 0.875rem 1rem; text-align: right; font-family: monospace; font-size: 0.75rem; color: #9ca3af;">NEFT-20260816-7712</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.875rem 1rem; font-weight: 500;">Cycle 17 (01 Sep – 15 Sep 2026)</td>
                            <td style="padding: 0.875rem 1rem; color: #9ca3af;">12 orders</td>
                            <td style="padding: 0.875rem 1rem; text-align: right;">₹134,200</td>
                            <td style="padding: 0.875rem 1rem; text-align: right; color: #f43f5e;">-₹20,130</td>
                            <td style="padding: 0.875rem 1rem; text-align: right; font-weight: 700; color: #4B1421;">₹114,070</td>
                            <td style="padding: 0.875rem 1rem; text-align: center;">
                                <x-filament::badge color="warning" size="sm">Accruing</x-filament::badge>
                            </td>
                            <td style="padding: 0.875rem 1rem; text-align: right; font-family: monospace; font-size: 0.75rem; color: #9ca3af;">Pending 16 Sep</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
