<div>
    <form method="POST" wire:submit.prevent='store()'>
        <div>
            <label for="billing-address" class="mt-4 mb-2 block text-sm text-gray-700 font-medium">Adresse de
                livraison</label>
            <div class="flex flex-col gap-4">
                <div class="relative flex flex-col gap-1.5 w-full">
                    <div class="relative flex items-center w-full">
                        <input type="text" id="billing-address" name="adresse" wire:model='adresse' required
                            class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:border-orange-500 focus:ring-orange-500"
                            placeholder="Adresse" />
                        <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                            <img class="h-4 w-6 border" src="{{ asset('assets/algeria.png') }}" />
                        </div>
                    </div>
                    @error('adresse')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900">
                        Wilaya
                    </label>
                    <select wire:model.live='selectedWilaya' id="selectedWilaya" name="selectedWilaya"
                        class="form-select block w-full shadow-sm rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 text-gray-900 ring-gray-300 focus:ring-orange-600">
                        <option value="">Choisir une wilaya</option>
                        @foreach ($wilayas as $wilaya)
                            <option value="{{ $wilaya->wilaya_name_ascii }}">{{ $wilaya->wilaya_code }} -
                                {{ $wilaya->wilaya_name_ascii }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900">
                        Daira
                    </label>
                    <select wire:model.live='selectedDaira' id="selectedDaira" name="selectedDaira"
                        class="form-select block w-full shadow-sm rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 text-gray-900 ring-gray-300 focus:ring-orange-600">
                        <option value="">Choisir une Daira</option>
                        @if ($selectedWilaya)
                            @foreach ($dairas as $daira)
                                <option value="{{ $daira->daira_name_ascii }}">{{ $daira->daira_name_ascii }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900">
                        Commune
                    </label>
                    <select wire:model='selectedCommune' id="selectedCommune" name="selectedCommune"
                        class="form-select block w-full shadow-sm rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 text-gray-900 ring-gray-300 focus:ring-orange-600">
                        <option value="">Choisir une Commune</option>
                        @if ($selectedDaira)
                            @foreach ($communes as $commune)
                                <option value="{{ $commune->commune_name_ascii }}">{{ $commune->commune_name_ascii }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-between md:px-4 px-2">
                <p class="text-md font-medium text-gray-900">Total</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $total }} DA</p>
            </div>
        </div>
        <button type="submit"
            class="mt-4 mb-3 w-full rounded-md bg-green-500 hover:bg-green-600 px-6 py-3 font-medium text-white">
            <span>Confirmer la commande</span>
        </button>

        <div wire:loading wire:target='store'
            class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center">
            <!-- Black background overlay -->
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <!-- Container -->
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="relative p-8">
                    <svg class="animate-spin h-16 w-16 text-center text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 6.627 5.373 12 12 12v-4a8.011 8.011 0 01-5.657-2.343z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </form>
    <form method="POST" wire:submit='cancel()'>
        @csrf
        <button type="submit"
            class="px-4 w-full py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-md transition-all"
            wire:loading.class='cursor-not-allowed' wire:loading.attr='disabled'>
            <span>Annuler</span>
        </button>
    </form>
</div>
