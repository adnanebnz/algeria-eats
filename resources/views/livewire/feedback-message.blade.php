<div>
    @if ($message)
        @if ($type === 'info')
            <div
                class="font-regular relative mb-4 block w-full rounded-lg bg-orange-500 p-4 text-base leading-5 text-white opacity-100 flex justify-between items-center">
                <div>{{ $message }}</div>
                <button wire:click="closeFeedbackMessage" class="p-1 text-white hover:text-gray-100 focus:outline-none">
                    <svg xmlns="http://w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        @if ($type === 'error')
            <div
                class="font-regular relative mb-4 block w-full rounded-lg bg-red-500 p-4 text-base leading-5 text-white opacity-100 flex justify-between items-center">
                <div>{{ $message }}</div>
                <button wire:click="closeFeedbackMessage" class="p-1 text-white hover:text-gray-100 focus:outline-none">
                    <svg xmlns="http://w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        @if ($type === 'success')
            <div
                class="font-regular relative mb-4 block w-full rounded-lg bg-green-500 p-4 text-base leading-5 text-white opacity-100 flex justify-between items-center">
                <div>{{ $message }}</div>
                <button wire:click="closeFeedbackMessage" class="p-1 text-white hover:text-gray-100 focus:outline-none">
                    <svg xmlns="http://w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        @if ($type === 'warning')
            <div
                class="font-regular relative mb-4 block w-full rounded-lg bg-orange-500 p-4 text-base leading-5 text-white opacity-100 flex justify-between items-center">
                <div>{{ $message }}</div>
                <button wire:click="closeFeedbackMessage" class="p-1 text-white hover:text-gray-100 focus:outline-none">
                    <svg xmlns="http://w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    @endif
</div>
