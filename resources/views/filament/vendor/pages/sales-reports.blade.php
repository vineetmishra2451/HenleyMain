@php
    $rows = $this->getWeeklyBreakdown();
    $totalGross = array_sum(array_column($rows, 'gross'));
    $totalCommission = array_sum(array_column($rows, 'commission'));
    $totalNet = array_sum(array_column($rows, 'net'));
@endphp

<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <!-- Date range and preset bar -->
        <x-filament::section>
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #9ca3af;">Interval Preset:</span>
                    <div style="display: inline-flex; border-radius: 0.5rem; padding: 0.25rem; gap: 0.25rem; background: rgba(156, 163, 175, 0.1);">
                        @foreach (['7d' => 'Last 7 Days', '30d' => 'Last 30 Days', '90d' => 'Quarter', '1y' => '1 Year'] as $key => $label)
                            <button
                                wire:click="setPreset('{{ $key }}')"
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 0.375rem; border: none; cursor: pointer; transition: all 0.15s; {{ $this->periodPreset === $key ? 'background: #4B1421; color: #ffffff;' : 'background: transparent; color: inherit;' }}"
                            >
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 1rem; font-size: 0.8125rem;">
                    <span style="color: #9ca3af;">Active Period: <strong style="color: currentColor;">{{ $this->startDate }}</strong> to <strong style="color: currentColor;">{{ $this->endDate }}</strong></span>
                </div>
            </div>
        </x-filament::section>

        <!-- KPI summary row -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;">
            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Period Gross Sales</p>
                <p style="font-size: 1.5rem; font-weight: 700; font-family: serif; color: currentColor; margin: 0.25rem 0 0 0;">₹{{ number_format($totalGross) }}</p>
                <p style="font-size: 0.75rem; color: #10b981; margin: 0.35rem 0 0 0;">Pre-deduction merchant volume</p>
            </x-filament::section>

            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Platform Commission (15%)</p>
                <p style="font-size: 1.5rem; font-weight: 700; font-family: serif; color: #f43f5e; margin: 0.25rem 0 0 0;">-₹{{ number_format($totalCommission) }}</p>
                <p style="font-size: 0.75rem; color: #9ca3af; margin: 0.35rem 0 0 0;">Contract curation fee</p>
            </x-filament::section>

            <x-filament::section>
                <p style="font-size: 0.75rem; font-weight: 600; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Estimated Net Payout</p>
                <p style="font-size: 1.5rem; font-weight: 700; font-family: serif; color: #4B1421; margin: 0.25rem 0 0 0;">₹{{ number_format($totalNet) }}</p>
                <p style="font-size: 0.75rem; color: #10b981; margin: 0.35rem 0 0 0;">Direct bank transfer</p>
            </x-filament::section>
        </div>

        <!-- Weekly breakdown table -->
        <x-filament::section>
            <x-slot name="heading">
                Weekly Revenue Breakdown & GST Ledger
            </x-slot>

            <x-slot name="description">
                Aggregated sales figures partitioned by fiscal calendar weeks for accounting reconciliation.
            </x-slot>

            <div style="overflow-x: auto; margin-top: 1rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(156, 163, 175, 0.2); font-size: 0.75rem; text-transform: uppercase; color: #9ca3af;">
                            <th style="padding: 0.75rem 1rem;">Settlement Period</th>
                            <th style="padding: 0.75rem 1rem; text-align: center;">Orders</th>
                            <th style="padding: 0.75rem 1rem; text-align: center;">Tins Sold</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Gross Sales</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">GST (5%)</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Commission</th>
                            <th style="padding: 0.75rem 1rem; text-align: right;">Net Payable</th>
                            <th style="padding: 0.75rem 1rem; text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr style="border-bottom: 1px solid rgba(156, 163, 175, 0.1);">
                                <td style="padding: 0.875rem 1rem; font-weight: 500;">{{ $row['period'] }}</td>
                                <td style="padding: 0.875rem 1rem; text-align: center; color: #9ca3af;">{{ $row['orders'] }}</td>
                                <td style="padding: 0.875rem 1rem; text-align: center;">
                                    <x-filament::badge color="gray" size="sm">{{ $row['units'] }}</x-filament::badge>
                                </td>
                                <td style="padding: 0.875rem 1rem; text-align: right; font-weight: 600;">₹{{ number_format($row['gross']) }}</td>
                                <td style="padding: 0.875rem 1rem; text-align: right; color: #9ca3af;">₹{{ number_format($row['tax']) }}</td>
                                <td style="padding: 0.875rem 1rem; text-align: right; color: #f43f5e;">-₹{{ number_format($row['commission']) }}</td>
                                <td style="padding: 0.875rem 1rem; text-align: right; font-weight: 700; color: #4B1421;">₹{{ number_format($row['net']) }}</td>
                                <td style="padding: 0.875rem 1rem; text-align: center;">
                                    <x-filament::badge :color="$row['status'] === 'Settled' ? 'success' : 'warning'" size="sm">
                                        {{ $row['status'] }}
                                    </x-filament::badge>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
