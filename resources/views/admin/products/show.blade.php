<x-dashboard-layout :isAdmin=true>
    <section class="mt-10 bg-white rounded-md py-4 px-4 shadow-md" x-data="{ currentImageIndex: 0 }">
        <div class="w-full px-4">
            <div>
                <p class="inline-block text-sm text-gray-700">
                    Nom du produit :
                    <span class="font-semibold text-lg">{{ $product->nom }}</span>
                </p>
                <div class="flex flex-wrap gap-2 items-center">
                    <p class="text-sm text-gray-600">Note du produit:</p>
                    <x-star-rating :rating="$product->rating" />
                </div>
                <div>
                    <p class="inline-block text-sm text-gray-700">
                        Prix :
                        <span class="font-semibold text-lg">{{ $product->prix }} DA</span>
                    </p>
                </div>
                <div class="mb-10 mt-4">
                    <h2 class="mb-2 text-lg font-bold text-gray-700">Description : </h2>
                    <span class="text-gray-600">
                        {{ $product->description }}
                    </span>
                </div>
            </div>
        </div>
        <div class="px-4 mx-auto">
            <div class="-mx-4">
                <div class="w-full px-4 mb-8 md:mb-0">
                    <div class="sticky top-0 overflow-hidden ">
                        <div class="relative mb-6 lg:mb-10 lg:h-96">
                            <button class="absolute left-0 transform lg:ml-2 top-1/2 translate-1/2"
                                x-on:click="currentImageIndex = (currentImageIndex - 1 + {{ count($product->images) }}) % {{ count($product->images) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
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
                            <button class="absolute right-0 transform lg:mr-2 top-1/2 translate-1/2"
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
                        <div class="grid grid-cols-5 -mx-2">
                            @foreach ($product->images as $key => $image)
                                <div>
                                    <button class="block border border-gray-200 hover:border-orange-400"
                                        x-on:click="currentImageIndex = {{ $key }}">
                                        <img class="object-contain w-full lg:h-60" src="{{ $image }}"
                                            alt="">
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="md:mt-16 mt-5">
                    <h1 class="text-xl font-semibold leading-loose tracking-wide text-gray-700 md:text-2xl">Commandes de
                        ce produit :
                    </h1>
                    <livewire:table-component :product="$product" />
                </div>
            </div>
    </section>
</x-dashboard-layout>
