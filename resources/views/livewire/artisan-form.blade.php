<form wire:submit.prevent="submit" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="flex flex-col gap-8">
        <div class="flex md:flex-row flex-col md:gap-8 gap-2">
            <div class="md:w-1/2 w-full flex flex-col gap-4">
                <x-input name="nom" label="Nom" type="text" />
                <x-input name="prenom" label="Prénom" type="text" />
                <div>
                    <label for="billing-address" class="mb-2 block text-sm text-gray-700 font-medium">Numéro de
                        télephone</label>
                    <div class="relative flex flex-col gap-1.5 w-full">
                        <div class="relative flex items-center w-full">
                            <input type="number" name="num_telephone" wire:model='num_telephone' required
                                class="w-full border border-gray-200 rounded-md px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:border-orange-500 focus:ring-orange-500"
                                placeholder="0512345678" />
                            <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                                <img class="h-4 w-6 border" src="{{ asset('assets/algeria.png') }}" />
                            </div>
                        </div>
                        @error('num_telephone')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <x-input name="adresse" label="Adresse" type="text" />
                <x-select name="wilaya" label="Wilaya" :list="$wilayas" :optionsValues="'wilaya_name_ascii'" :optionsSubTexts="'wilaya_code'"
                    :optionsTexts="'wilaya_name_ascii'" />
                <x-textarea name="desc_entreprise" label="Description Entreprise" />

            </div>
            <div class="md:w-1/2 w-full flex flex-col gap-4">
                <x-input name="heure_ouverture" label="Heure d'ouverture" type="time" />
                <x-input name="heure_fermeture" label="Heure de fermeture" type="time" />
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">Type Service</label>
                    <select name="type_service" wire:model='type_service'
                        class="form-select block w-full shadow-sm rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 text-gray-900 ring-gray-300 focus:ring-orange-600">
                        <option value="sucree">Sucrée</option>
                        <option value="salee">Salée</option>
                        <option value="sucree_salee">Sucrée et Salée</option>
                    </select>
                </div>
                <x-input name="email" label="Email" type="email" />
                <div x-data="{ showPassword: false }" class="relative mt-1">
                    <label for="password" class="block text-sm font-medium text-gray-700 select-none">
                        Mot de passe
                    </label>

                    <div class="flex items-center mt-2">
                        <input :type="showPassword ? 'text' : 'password'" wire:model="password" name="password"
                            class="form-input flex-1  w-full rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 text-gray-900 shadow-sm ring-gray-300 placeholder:text-gray-400 focus:ring-orange-600"
                            type="password">
                        <button type="button"
                            class="absolute right-2 bg-transparent flex items-center justify-center hover:text-orange-600"
                            @click="showPassword = !showPassword">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                </path>
                            </svg>

                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div x-data="{ showPasswordConfirmation: false }" class="relative mt-1">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 select-none">
                        Confirmer le Mot de Passe
                    </label>
                    <div class="flex items-center mt-2">
                        <input :type="showPasswordConfirmation ? 'text' : 'password'" wire:model="password_confirmation"
                            name="password_confirmation"
                            class="form-input flex-1  w-full rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 text-gray-900 shadow-sm ring-gray-300 placeholder:text-gray-400 focus:ring-orange-600"
                            type="password">
                        <button type="button"
                            class="absolute right-2 bg-transparent flex items-center justify-center hover:text-orange-600"
                            @click="showPasswordConfirmation = !showPasswordConfirmation">
                            <svg x-show="!showPasswordConfirmation" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                </path>
                            </svg>

                            <svg x-show="showPasswordConfirmation" class="w-5 h-5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div x-data="{ image: null }">
            <label class="block text-sm font-medium text-white">
                Image
            </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-4 text-center">
                    <template x-if="image">
                        <img x-bind:src="image" alt="Uploaded Image"
                            class="h-32 mx-auto mb-4 rounded-full border">
                    </template>
                    <div class="flex flex-col gap-1 items-center justify-center">
                        <template x-if="!image">
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
                                    une photo</span>
                                <input id="file-upload" name="image" wire:model='image' type="file"
                                    class="sr-only" accept="image/*"
                                    x-on:change="image = URL.createObjectURL($event.target.files[0])">
                            </label>
                        </div>
                        <p class="text-xs">
                            PNG, JPEG, JPG, GIF Maximum 4 méga.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500">
                Créer
                votre compte
            </button>
            <div wire:loading class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center">
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
        </div>
    </div>
</form>
