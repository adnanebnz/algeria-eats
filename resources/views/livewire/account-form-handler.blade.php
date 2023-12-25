<div>
    <select wire:model.live="selectedAccountType"
            class="form-select w-full rounded-md border-0 border-orange-500 py-2.5 ring-1 ring-inset focus:ring-2 ring-orange-500 focus:ring-orange-500 focus:ring-inset sm:text-sm sm:leading-6 mb-4">
        <option value="consumer">Client</option>
        <option value="artisan">Artisan</option>
        <option value="delivery_man">Livreur</option>
    </select>
    <div wire:loading
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 bg-black/95 p-6 rounded-md flex items-center justify-center text-center">
        <svg class="animate-spin h-16 w-16 text-center text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 6.627 5.373 12 12 12v-4a8.011 8.011 0 01-5.657-2.343z">
            </path>
        </svg>
    </div>

    @if ($selectedAccountType === 'consumer')
        <livewire:consumer-form/>
    @elseif($selectedAccountType === 'artisan')
        <livewire:artisan-form/>
    @elseif($selectedAccountType === 'delivery_man')
        <livewire:delivery-man-form/>
    @endif
</div>
