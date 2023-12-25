<div>
    @if ($products->count() > 0)
        <div class="max-w-screen-xl mx-auto md:mt-20 pt-5">
            <h1 class="font-bold md:text-3xl text-xl text-gray-800">Produits en vedette</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10 mt-5">
                @foreach ($products as $product)
                    <div class="rounded overflow-hidden shadow-lg">
                        <a href="{{ route('product.show', $product->id) }}"></a>
                        <div class="relative">
                            <a href="{{ route('product.show', $product->id) }}">
                                <img class="h-64 w-full object-cover transition duration-500 group-hover:scale-105"
                                    src="{{ str_starts_with($product->images[0], 'http') ? $product->images[0] : asset('storage/' . $product->images[0]) }}"
                                    alt="Sunset in the mountains">
                                <div
                                    class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                                </div>
                            </a>
                            <a href="#!">
                                <div
                                    class="absolute bottom-0 left-0 bg-orange-600 px-4 py-2 text-white text-sm hover:bg-white hover:text-orange-600 transition duration-500 ease-in-out">
                                    @if ($product->categorie === 'sucree')
                                        Sucrée
                                    @else
                                        Salée
                                    @endif
                                </div>
                            </a>

                            <a href="!#">
                                <div
                                    class="text-sm absolute top-0 right-0 bg-orange-600 px-2 py-0.5 text-white rounded-lg flex gap-1 items-center justify-center mt-3 mr-3 hover:bg-white hover:text-orange-600 transition duration-500 ease-in-out">
                                    <span class="font-bold">{{ $product->rating }}</span>
                                    <small><i class="fas fa-star text-yellow-300"></i></small>
                                </div>
                            </a>
                        </div>
                        <div class="px-6 py-4">

                            <a href="#"
                                class="font-medium text-lg inline-block hover:text-orange-600 transition duration-500 ease-in-out">{{ $product->nom }}</a>
                            <p class="text-gray-800 font-bold">
                                {{ $product->prix }} DA
                            </p>
                        </div>
                        <div class="px-6 pb-3 pt-2">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="py-1 text-md font-regular text-gray-900">
                                <div class="group items-center inline-flex">
                                    <span class="group-hover:text-gray-500 transition-colors">Voir plus</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6 text-gray-700 group-hover:translate-x-0.5 transition-transform group-hover:text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
