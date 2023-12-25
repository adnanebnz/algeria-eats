<div>
    <section class="bg-white" x-data="{ artisanRating: @entangle('artisanRating') }">
        <div class="container px-4 pb-5 md:pb-7 mx-auto mt-5">
            {{-- START SEARCH FILTER --}}
            <div class="md:px-44">
                <h1 class="font-bold md:text-3xl text-xl text-gray-700">Rechercher un Artisan</h1>
            </div>
            <div class="flex flex-col mx-auto mb-16 mt-5 md:max-w-4xl w-full">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-md">
                    <form wire:submit.prevent="applyFilters">
                        <div class="relative mb-10 w-full flex  items-center justify-between rounded-md">
                            <svg class="absolute left-2 block h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" class=""></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65" class=""></line>
                            </svg>
                            <input type="name" name="search" value="{{ request()->search }}" wire:model="search"
                                class="h-12 w-full cursor-text rounded-md border border-gray-100 bg-gray-100 py-4 md:pr-40 pl-12 shadow-sm outline-none focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                                placeholder="Nom de l'artisan" />
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <x-select name="artisanWilaya" label="Wilaya d'artisan" :list="$wilayas" :optionsValues="'wilaya_name_ascii'"
                                :optionsSubTexts="'wilaya_code'" :optionsTexts="'wilaya_name_ascii'" />
                            <div class="flex flex-col">
                                <label for="manufacturer" class="text-sm font-medium text-stone-600">Type de
                                    Service</label>
                                <select id="manufacturer" name="typeService" wire:model="typeService"
                                    class="mt-2 block md:w-4/5 w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                    <option value="">Choisir</option>
                                    <option value="sucree" @if (request()->typeService == 'sucree') selected @endif>
                                        Sucrée
                                    </option>
                                    <option value="salee" @if (request()->typeService == 'salee') selected @endif>Salée
                                    </option>
                                    <option value="sucree_salee" @if (request()->typeService == 'sucree_salee') selected @endif>
                                        Sucrée et
                                        Salée
                                    </option>
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label for="status" class="text-sm font-medium text-stone-600">Note
                                    d'artisan</label>

                                <div class="w-fit h-fit inline-block mt-3"
                                    x-on:click="artisanRating = $event.target.dataset.rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i data-rating="{{ $i }}"
                                            x-bind:class="{
                                                'fas fa-star text-yellow-400 hover:text-yellow-500 text-2xl': artisanRating >=
                                                    {{ $i }},
                                                'far fa-star text-yellow-400 hover:text-yellow-500 text-2xl': artisanRating <
                                                    {{ $i }}
                                            }"
                                            class="cursor-pointer"></i>
                                    @endfor
                                </div>

                                <input id="artisanRating" name="artisanRating" type="hidden"
                                    wire:model="artisanRating">
                            </div>
                        </div>

                        <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                            <a wire:click.prevent="resetFilters"
                                class="rounded-lg bg-gray-200 md:px-8 px-2 py-2 font-medium text-gray-700 text-center outline-none hover:opacity-80 cursor-pointer">Réinitialiser</a>
                            <button
                                class="rounded-lg bg-orange-600 md:px-8 px-2 py-2 font-medium text-white outline-none hover:opacity-80">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- END SEARCH FILTER --}}
            <div class="mt-6 md:mt-0 md:px-2">
                <div id="artisans-section">
                    <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-3 lg:grid-cols-3">
                        @forelse ($artisans as $artisan)
                            <a href="{{ route('profile', $artisan->user->id) }}"
                                class="relative block overflow-hidden shadow-lg border p-3 hover:opacity-80">
                                <div class="flex flex-row items-center gap-2">
                                    <img src="{{ $artisan->user->image ? (str_starts_with($artisan->user->image, 'http') ? $artisan->user->image : asset('storage/' . $artisan->user->image)) : asset('assets/user.png') }}"
                                        class="object-cover w-12 h-12 rounded-full border"
                                        alt="artisan profile picture" />
                                    <div class="flex flex-col justify-center">
                                        <p class="ml-2 text-sm font-medium text-gray-700">
                                            {{ $artisan->user->getFullName() }}</p>
                                        <x-star-rating :rating="$artisan->rating" />
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 mt-3">
                                    <div class="flex flex-row items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" data-slot="icon"
                                            class="w-8 h-8 text-gray-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>

                                        <p class="text-sm text-gray-700">{{ $artisan->user->adresse }}
                                            - {{ $artisan->user->wilaya }}</p>
                                    </div>
                                    <div class="flex flex-row items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" data-slot="icon"
                                            class="w-6 h-6 text-gray-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6h.008v.008H6V6Z" />
                                        </svg>
                                        @if ($artisan->type_service === 'sucree')
                                            <p class="text-sm text-gray-700">Sucrée</p>
                                        @elseif($artisan->type_service === 'salee')
                                            <p class="text-sm text-gray-700">Salée</p>
                                        @elseif($artisan->type_service === 'sucree_salee')
                                            <p class="text-sm text-gray-700">Sucrée et Salée</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="flex flex-col items-center justify-center w-full col-span-3">
                                <img src="{{ asset('assets/not-found.svg') }}" alt="empty" class="h-48" />
                                <p class="text-gray-700 text-xl font-bold mt-3">Aucun résultat trouvé</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
        <div class="mb-5 md:px-11 px-4">
            {{ $artisans->links(data: ['scrollTo' => '#artisans-section']) }}
        </div>
    </section>
</div>
