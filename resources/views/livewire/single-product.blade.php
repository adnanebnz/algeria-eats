<div>

    @if (!empty($feedbackMessage))
        <livewire:feedback-message :message='$feedbackMessage' :type='$feedbackMessageType' />
    @endif
    <section class="pb-6" x-data="{ currentImageIndex: 0 }">
        <div class="max-w-6xl px-4 mx-auto">
            <div class="flex flex-wrap mb-24 -mx-4">
                <div class="w-full px-4 mb-8 md:w-1/2 md:mb-0">
                    <div class="sticky top-0 overflow-hidden">
                        <div class="relative mb-6 lg:mb-10 lg:h-96">
                            <button class="absolute hidden md:block left-0 transform lg:ml-2 top-1/2 translate-1/2"
                                x-on:click="currentImageIndex = (currentImageIndex - 1 + {{ count($product->images) }}) % {{ count($product->images) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="w-5 h-5 text-orange-500 hover:text-orange-200 bi bi-chevron-left"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                    </path>
                                </svg>
                            </button>
                            @foreach ($product->images as $key => $image)
                                <img class="object-contain w-full lg:h-full"
                                    x-bind:class="{ 'hidden': currentImageIndex !== {{ $key }} }"
                                    src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}"
                                    alt="">
                            @endforeach
                            <button class="absolute right-0 hidden md:block transform lg:mr-2 top-1/2 translate-1/2"
                                x-on:click="currentImageIndex = (currentImageIndex + 1) % {{ count($product->images) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
                                    class="w-5 h-5 text-orange-500 hover:text-orange-200 bi bi-chevron-right"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="-mx-2 flex">
                            @foreach ($product->images as $key => $image)
                                <div class="w-1/3 p-2 sm:w-1/5">
                                    <button class="block border border-gray-200 hover:border-orange-400"
                                        x-on:click="currentImageIndex = {{ $key }}">
                                        <img class="object-contain w-full lg:h-28" src="{{ $image }}"
                                            alt="">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 md:w-1/2">
                    <div class="lg:pl-20">
                        <div class="mb-6 ">
                            <h2
                                class="max-w-xl mt-6 mb-2 text-xl font-semibold leading-loose tracking-wide text-gray-700 md:text-2xl">
                                {{ $product->nom }}
                            </h2>
                            <div class="flex flex-wrap items-center mb-2">
                                <div class="mb-4 mr-2 lg:mb-0">
                                    <p class="text-sm text-gray-600">Note du produit</p>
                                    <x-star-rating :rating="$product->rating" />
                                </div>
                            </div>
                            <div class="flex flex-col mb-6">
                                <p class="text-sm text-gray-600">De: <a
                                        class="font-medium text-gray-900 hover:text-orange-500 hover:underline underline-offset-2"
                                        href="{{ route('profile', $product->artisan->user) }}">{{ $product->artisan->user->getFullName() }}</a>
                                </p>
                                <x-star-rating :rating="$product->artisan->rating" />
                            </div>
                            <p class="inline-block text-2xl font-semibold text-gray-700">
                                <span>{{ $product->prix }} DA</span>
                            </p>
                        </div>
                        <div class="mb-6">
                            <h2 class="mb-2 text-lg font-bold text-gray-700">Description : </h2>
                            <span class="text-gray-600">
                                {{ $product->description }}
                            </span>
                        </div>
                        <div class="mb-6 flex items-center gap-1">
                            <h2 class="text-lg font-bold text-gray-700">Catégorie : </h2>
                            <span class="text-gray-600">
                                @if ($product->categorie === 'sucree')
                                    <span
                                        class="inline-flex items-center m-2 px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-semibold text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6h.008v.008H6V6Z" />
                                        </svg>
                                        <span class="ml-1">
                                            Sucrée
                                        </span>
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center m-2 px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-semibold text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 6h.008v.008H6V6Z" />
                                        </svg>

                                        <span class="ml-1">
                                            Salée
                                        </span>
                                    </span>
                                @endif
                        </div>
                        <div class="mb-6 mt-10"></div>
                        <div class="flex flex-wrap items-center justify-center">
                            <div class="mb-4 mr-4 lg:mb-0">
                                <div class="w-28">
                                    <div class="relative flex flex-row w-full h-10 bg-transparent rounded-lg">
                                        <button wire:click="decrementQuantity"
                                            class="w-20 h-full text-gray-600 bg-gray-100 border-r rounded-l outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300">
                                            <span class="m-auto text-2xl font-thin">-</span>
                                        </button>
                                        <input type="number" wire:model="quantity"
                                            class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-100 outline-none focus:outline-none text-md hover:text-black"
                                            placeholder="1">
                                        <button wire:click="incrementQuantity"
                                            class="w-20 h-full text-gray-600 bg-gray-100 border-l rounded-r outline-none cursor-pointer hover:text-gray-700 hover:bg-gray-300">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button wire:click="addToCart()"
                                class="w-full px-4 py-3 text-center text-orange-600 bg-orange-100 border border-orange-600 hover:bg-orange-600 hover:text-gray-100 lg:w-1/2 rounded-xl">
                                Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
                @auth
                    <livewire:comment-form :product='$product' />
                @endauth
                <livewire:comment-component :product='$product' />
            </div>
        </div>
    </section>
</div>
