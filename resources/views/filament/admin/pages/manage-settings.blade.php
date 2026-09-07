<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <x-heroicon-m-lock-closed style="width: 16px; height: 16px; flex-shrink: 0;" class="text-emerald-600 dark:text-emerald-400" />
                <span>Secret API keys and passwords are masked at rest with reveal toggles.</span>
            </div>

            <button
                type="submit"
                class="inline-flex items-center gap-x-2 px-5 py-2.5 text-sm font-semibold rounded-lg bg-[#4B1421] text-white hover:bg-[#380e18] shadow-sm transition"
            >
                <x-heroicon-m-check style="width: 16px; height: 16px; flex-shrink: 0;" />
                <span>Save All Settings</span>
            </button>
        </div>
    </form>
</x-filament-panels::page>
