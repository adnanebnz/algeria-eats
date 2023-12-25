<x-dashboard-layout :isAdmin=true>
    <div class="bg-white rounded-md shadow-lg mt-5">
        <section class="antialiased font-sans">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h2 class="text-2xl font-semibold leading-tight">Modifier l'utilisateur</h2>
                    </div>
                </div>
                <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="POST" class="mb-2"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex md:flex-row flex-col gap-8">
                        <div class="md:w-1/2 flex flex-col gap-4">
                            <x-input name="nom" label="Nom" type="text" :value="$user->nom" />
                            <x-input name="adresse" label="Adresse" type="text" :value="$user->adresse" />
                            <x-input name="email" label="Email" type="email" :value="$user->email" />
                            @if ($user && $user->artisan)
                                <x-textarea name="desc_entreprise" label="Description d'entreprise"
                                    type="text">{{ $user->artisan->desc_entreprise }}</x-textarea>
                                <x-input name="heure_ouverture" label="Heure d'ouverture" type="time"
                                    :value="$user->artisan?->heure_ouverture" />
                            @endif
                        </div>
                        <div class="md:w-1/2 flex flex-col gap-4">
                            <x-input name="prenom" label="Prénom" type="text" :value="$user->prenom" />
                            <x-select name="wilaya" label="Wilaya" :list="$wilayas" :optionsValues="'wilaya_name_ascii'"
                                :optionsSubTexts="'wilaya_code'" :optionsTexts="'wilaya_name_ascii'" :value="$user->wilaya" />

                            <x-input name="num_telephone" label="Numéro de teléphone" type="text"
                                :value="$user->num_telephone" />
                            <div x-data="{ showPassword: false }" class="relative mt-1">
                                <label for="password" class="block text-sm font-medium text-gray-700 select-none">
                                    Mot de passe
                                </label>

                                <div class="flex items-center mt-2">
                                    <input :type="showPassword ? 'text' : 'password'" wire:model="password"
                                        name="password"
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
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                            style="display: none;">
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
                            @if ($user && $user->artisan)
                                <div>
                                    <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">Type
                                        Service</label>
                                    <select
                                        class="form-select w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                                        name="type_service">
                                        <option value="sucree" @selected($user->artisan->type_service === 'sucree')>
                                            Sucrée
                                        </option>
                                        <option value="salee" @selected($user->artisan->type_service === 'salee')>
                                            Salée
                                        </option>
                                        <option value="sucree_salee" @selected($user->artisan->type_service === 'sucree_salee')>
                                            Sucrée et Salée
                                        </option>
                                    </select>
                                </div>

                                <x-input name="heure_fermeture" label="Heure de fermeture" type="time"
                                    :value="$user->artisan->heure_fermeture" />
                            @endif
                            @if ($user && $user->deliveryMan)
                                <div>
                                    <label
                                        class="block text-sm font-medium leading-6 text-gray-900 mb-2">Disponible?</label>
                                    <select
                                        class="form-select w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                                        name="est_disponible" label="Êtes-vous disponible ?">
                                        <option>Choisir</option>
                                        <option value="1" @if (old('est_disponible', $user->deliveryMan->est_disponible) == true) selected @endif>
                                            Disponible
                                        </option>
                                        <option value="0" @if (old('est_disponible', $user->deliveryMan->est_disponible) == false) selected @endif>Non
                                            disponible
                                        </option>
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div x-data="{ image: null }">
                        <label class="block text-sm font-medium text-white">
                            Image
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
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
                                            <input id="file-upload" name="image" type="file" class="sr-only"
                                                accept="image/*"
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

                    <button type="submit"
                        class="bg-orange-700 hover:bg-orange-800 px-6 py-2 rounded-md mt-8 text-white">MODIFIER
                        LES INFORMATIONS</button>
                </form>
                <form method="POST" action="{{ route('profile.destroy', ['user' => $user]) }}"
                    class="flex justify-end pb-5" x-data="{ showModal: false }">
                    @csrf
                    @method('DELETE')
                    <!-- Modal toggle -->
                    <button type="button" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md"
                        @click="showModal = true">
                        Supprimer ce compte
                    </button>
                    <div x-show="showModal" x-cloak
                        class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center">
                        <!-- Black background overlay -->
                        <div class="absolute inset-0 bg-black opacity-50">
                        </div>
                        <!-- Modal container -->
                        <div x-show="showModal" x-cloak x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            class="relative p-8 bg-white mx-auto max-w-lg">
                            <!-- Modal content -->
                            <div @click.away="showModal = false">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between">
                                    <div></div>
                                    <button type="button" @click="showModal = false"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="space-y-4">
                                    <svg class="mx-auto mb-4 text-gray-400 w-14 h-14" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <p class="text-base leading-relaxed text-gray-700">
                                        Vous voulez vraiment supprimer cet utilisateur ?
                                    </p>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-center mt-6">
                                    <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        @click="showModal = false">Confirmer</button>
                                    <button type="button"
                                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-orange-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                        @click="showModal = false">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-dashboard-layout>
