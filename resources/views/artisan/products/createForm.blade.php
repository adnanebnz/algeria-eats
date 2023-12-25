<x-dashboard-layout :isArtisan=true>
    <form action="{{ route('artisan.products.store') }}" method="POST" enctype="multipart/form-data"
        class="md:px-20 px-3 shadow-sm p-1 pb-4 md:pb-10 mt-5">
        @csrf
        <div>
            <div class="border-gray-900/10 pb-12">
                <h1 class="text-xl font-bold leading-7 text-gray-700">
                    Créer un produit
                </h1>

                <div class="mt-10 flex  flex-col items-center justify-center gap-6">
                    <div class="flex flex-col gap-5 w-full">
                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                        <x-input name="nom" label="Nom" />
                        <x-textarea name="description" label="Description" />
                    </div>
                    <div class="flex flex-col gap-5 w-full">
                        <div>
                            <label class="block text-sm font-medium leading-6 text-gray-900">
                                Catégorie
                            </label>
                            <select name="categorie"
                                class="form-select block w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6  mt-2">
                                <option>Choisir une catégorie</option>
                                <option value="sucree">Sucrée</option>
                                <option value="salee">Salée</option>
                            </select>
                        </div>
                        <x-input name="prix" label="Prix" />
                    </div>
                    <div x-data="{ images: [] }" class="w-full">
                        <label class="block text-sm font-medium text-white">
                            Images
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-4 text-center">
                                <template x-if="images.length > 0">
                                    <!-- Use x-for to loop through images -->
                                    <div
                                        class="grid grid-cols-5 gap-4 items-center justify-center place-content-center">
                                        <template x-for="image in images" :key="image.name">
                                            <img x-bind:src="URL.createObjectURL(image)" alt="Uploaded Image"
                                                class="h-32 mx-auto mb-4 border">
                                        </template>
                                    </div>
                                </template>
                                <div class="flex flex-col gap-1 items-center justify-center">
                                    <template x-if="images.length === 0">
                                        <svg class="h-14 w-14 text-gray-600" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </template>
                                    <div class="flex text-sm text-gray-800 my-2">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md font-medium text-orange-600 hover:text-orange-500">
                                            <span
                                                class="border p-2 border-orange-500 bg-transparent hover:bg-orange-500 hover:text-white hover:rounded-md">Télécharger
                                                les photos</span>
                                            <input id="file-upload" name="images[]" type="file" class="sr-only"
                                                accept="image/*" multiple @change="images = $event.target.files">
                                        </label>
                                    </div>
                                    <p class="text-xs">
                                        PNG, JPEG, JPG, WEBP Maximum 5 photos de 4 méga.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @error('images')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit"
                class="rounded-md bg-orange-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                Créer le produit
            </button>
        </div>
    </form>
</x-dashboard-layout>
