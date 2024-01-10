<div>
    <section class="bg-white" x-data="{ artisanRating: @entangle('artisanRating'), productRating: @entangle('productRating') }">
        <div class="container px-4 pb-5 md:pb-7 mx-auto mt-5">
            {{-- START SEARCH FILTER --}}
            <div class="md:px-44">
                <h1 class="font-bold md:text-3xl text-xl text-gray-700">Rechercher votre produit</h1>
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
                                placeholder="Nom du produit" />
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                            <div class="flex flex-col">
                                <label for="name" class="text-sm font-medium text-stone-600">Nom de
                                    l'artisan</label>
                                <input type="text" id="name" placeholder="Nom ou prénom" name="artisan"
                                    wire:model="artisan" value="{{ request()->artisan }}"
                                    class="mt-2 block w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50" />
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
                            <div class="flex flex-col">
                                <label for="manufacturer" class="text-sm font-medium text-stone-600">Type de
                                    produit</label>

                                <select id="manufacturer" name="productType" wire:model="productType"
                                    class="mt-2 block md:w-4/5 w-full rounded-md border border-gray-100 bg-gray-100 px-2 py-2 shadow-sm outline-none focus:border-orange-500 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                    <option value="">Choisir</option>
                                    <option value="sucree" @if (request()->productType == 'sucree') selected @endif>Sucrée
                                    </option>
                                    <option value="salee" @if (request()->productType == 'salee') selected @endif>Salée
                                    </option>
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label for="status" class="text-sm font-medium text-stone-600">Note du
                                    produit</label>

                                <div class="w-fit h-fit inline-block mt-3"
                                    x-on:click="productRating = $event.target.dataset.rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i data-rating="{{ $i }}"
                                            x-bind:class="{
                                                'fas fa-star text-yellow-400 hover:text-yellow-500 text-2xl': productRating >=
                                                    {{ $i }},
                                                'far fa-star text-yellow-400 hover:text-yellow-500 text-2xl': productRating <
                                                    {{ $i }}
                                            }"
                                            class="cursor-pointer"></i>
                                    @endfor
                                </div>

                                <input id="productRating" name="productRating" type="hidden"
                                    wire:model="productRating">
                            </div>
                        </div>

                        <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                            <a wire:click.prevent="resetFilters"
                                class="rounded-lg bg-gray-200 md:px-8 px-2 py-2 font-medium text-gray-700 text-center outline-none hover:opacity-80 cursor-pointer">Réinitialiser</a>
                            <button
                                class="rounded-lg bg-orange-600 md:px-8 px-2 py-2 font-medium text-white outline-none hover:opacity-80">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- END SEARCH FILTER --}}
            <div class="mt-6 md:mt-0 md:px-2">
                <div class="flex items-center justify-between text-sm tracking-widest uppercase" id="products-section">
                    <div> </div>
                    <div class="flex items-center gap-2">
                        <p class="text-gray-500 ">TRIER</p>
                        <select class="font-medium text-gray-700 bg-transparent focus:outline-none"
                            wire:model='orderDirection' wire:change="applyFilters">
                            <option value="asc">Prix: de faible à élevé</option>
                            <option value="desc">Prix: de élevé à faible</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-3 lg:grid-cols-4">
                        @forelse ($products as $product)
                            <a href="{{ route('product.show', $product) }}"
                                class="relative block overflow-hidden shadow-lg border">
                                <img src="{{ str_starts_with($product->images[0], 'http') ? $product->images[0] : asset('storage/' . $product->images[0]) }}"
                                    class="h-64 w-full object-cover transition duration-500 group-hover:scale-105" />

                                <div class="relative bg-white p-4">
                                    <span
                                        class="whitespace-nowrap bg-orange-500 text-white px-2 py-1.5 text-xs font-medium">
                                        {{ $product->categorie === 'sucree' ? 'Sucrée' : 'Salée' }}
                                    </span>

                                    <h3 class="mt-4 font-medium text-gray-900">{{ $product->nom }}</h3>

                                    <x-star-rating :rating="$product->rating" />

                                    <p class="mt-1.5 text-md text-gray-800">{{ $product->prix }} DA</p>

                                    <form class="mt-4">
                                        <button wire:click.prevent="store({{ $product->id }})"
                                            class="block w-full rounded bg-orange-500 p-4 text-sm font-medium text-white transition hover:scale-105">
                                            Ajouter au panier
                                        </button>
                                    </form>
                                </div>
                            </a>
                        @empty
                            <div class="flex flex-col items-center justify-center w-full col-span-5">
                                <img src="{{ asset('assets/not-found.svg') }}" alt="empty" class="h-48" />
                                <p class="text-gray-700 text-xl font-bold mt-3">Aucun résultat trouvé</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5 md:px-11 px-4">
            {{ $products->links(data: ['scrollTo' => '#products-section']) }}
        </div>
    </section>
</div>
