<x-default-layout title="Profile">
    <div class="md:container mx-auto bg-gray-100 rounded-md shadow-sm p-3 md:p-5">
        <div class="md:container mx-auto my-5">
            <div class="md:flex w-full">
                <div class="w-full md:w-3/12">
                    <div class="bg-white p-3 border-t-4 border-orange-400 shadow-sm rounded-md">
                        <div class="image overflow-hidden">
                            <img class="h-auto w-full mx-auto object-cover"
                                src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                alt="">
                        </div>
                        <div class="flex gap-2">
                            <img src="{{ $user->image ? (str_starts_with($user->image, 'http') ? $user->image : asset('storage/' . $user->image)) : asset('assets/user.png') }}"
                                alt="image" class="h-14 w-14 rounded-full">
                            <div>
                                <h1 class="text-gray-900 font-semibold text-md">{{ $user->getFullName() }}
                                </h1>
                                @if ($user->isArtisan())
                                    <x-star-rating :rating="$user->artisan->rating" />
                                @elseif ($user->isDeliveryMan())
                                    <x-star-rating :rating="$user->deliveryMan->rating" />
                                @endif
                            </div>
                        </div>
                        <ul
                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                            <li class="flex items-center py-3">
                                <span>Role</span>
                                <span class="ml-auto"><span
                                        class="bg-orange-500 py-1 px-2 rounded text-white text-sm"><span
                                            class="text-md font-normal">
                                            @if ($user->isArtisan())
                                                Artisan
                                            @elseif($user->isConsumer())
                                                Consomateur
                                            @elseif($user->isDeliveryMan())
                                                Livreur
                                            @else
                                                Admin
                                            @endif
                                        </span></span></span>
                            </li>
                            @if ($user->isArtisan())
                                <li class="flex items-center py-3">
                                    <span>Spécialité</span>
                                    <span class="ml-auto"><span
                                            class="bg-orange-500 py-1 px-2 rounded text-white text-sm"><span
                                                class="text-md font-normal">
                                                @if ($user->artisan?->type_service === 'sucree')
                                                    Sucrée
                                                @elseif($user->artisan?->type_service === 'salee')
                                                    Salée
                                                @else
                                                    Sucrée et Salée
                                                @endif
                                            </span></span></span>
                                </li>
                            @endif
                            @if ($user->isDeliveryMan())
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto"><span
                                            class="bg-orange-500 py-1 px-2 rounded text-white text-sm">
                                            {{ $user->deliveryMan->est_disponible ? 'Disponible' : 'Indisponible' }}
                                        </span></span>
                                </li>
                            @endif
                            <li class="flex items-center py-3">
                                <span>Membre depuis</span>
                                <span
                                    class="ml-auto">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="my-4"></div>
                    @if (($user->isArtisan() && $similarArtisans) || ($user->isDeliveryMan() && $similarDeliveryMen))
                        @if ($similarArtisans?->count() > 0 || $similarDeliveryMen?->count() > 0)
                            <div class="bg-white p-3 hover:shadow">
                                <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                    <span class="text-orange-500">
                                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </span>
                                    <span>Profils similaires</span>
                                </div>
                                @if ($user->isArtisan())

                                    <div class="grid grid-cols-3">
                                        @foreach ($similarArtisans as $similarArtisan)
                                            @if ($similarArtisan->id !== $user->id)
                                                <div class="text-center my-2 text-xs">
                                                    <img class="h-10 w-10 rounded-full mx-auto mb-1"
                                                        src="{{ $similarArtisan->image ? (str_starts_with($similarArtisan->image, 'http') ? $similarArtisan->image : asset('storage/' . $similarArtisan->image)) : asset('assets/user.png') }}"
                                                        alt="">
                                                    <a href="{{ route('profile', $similarArtisan->id) }}"
                                                        class="text-main-color">{{ $similarArtisan->prenom }}</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @elseif ($user->isDeliveryMan())
                                    <div class="grid grid-cols-3">
                                        @foreach ($similarDeliveryMen as $similarDeliveryMan)
                                            @if ($similarDeliveryMan->id !== $user->id)
                                                <div class="text-center my-2 text-xs">
                                                    <img class="h-10 w-10 rounded-full mx-auto mb-1"
                                                        src="{{ $similarDeliveryMan->image ? (str_starts_with($similarDeliveryMan->image, 'http') ? $similarDeliveryMan->image : asset('storage/' . $similarDeliveryMan->image)) : asset('assets/user.png') }}"
                                                        alt="">
                                                    <a href="{{ route('profile', $similarDeliveryMan->id) }}"
                                                        class="text-main-color">{{ $similarDeliveryMan->prenom }}</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
                <!-- Right Side -->
                <div class="w-full md:w-9/12 md:mx-3 mx-0 mt-3 md:mt-0">
                    <!-- Profile tab -->
                    <!-- About Section -->
                    <div class="bg-white p-3 shadow-sm rounded-sm overflow-auto">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <span class="text-orange-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">A propos</span>
                        </div>
                        <div class="text-gray-700">
                            <div class="grid md:grid-cols-2 text-sm">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Nom</div>
                                    <div class="px-4 py-2">{{ $user->nom }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Prénom</div>
                                    <div class="px-4 py-2">{{ $user->prenom }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Adresse</div>
                                    <div class="px-4 py-2">{{ $user->adresse }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Wilaya</div>
                                    <div class="px-4 py-2">{{ $user->wilaya }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email</div>
                                    <div class="px-4 py-2">
                                        <a class="text-blue-800"
                                            href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Numéro de téléphone</div>
                                    <div class="px-4 py-2">{{ $user->num_telephone }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($user->isArtisan())
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span class="text-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>

                                </span>
                                <span class="tracking-wide">Entrerpise</span>
                            </div>
                            <div class="text-gray-700">
                                <div class="text-sm mt-4">
                                    <div class="font-semibold px-4 py-1">Description:</div>
                                    <div class="px-4">{{ $user->artisan->desc_entreprise }}</div>
                                </div>

                                <div class="grid md:grid-cols-2 text-sm mt-5">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Heure d'ouverture</div>
                                        <div class="px-4 py-2">{{ $user->artisan->heure_ouverture }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Heure de fermeture</div>
                                        <div class="px-4 py-2">{{ $user->artisan->heure_fermeture }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="my-4"></div>
                    @if ($user->isArtisan())
                        @if ($user->artisan && $artisanProducts?->count() > 0)
                            <div class="bg-white p-3 shadow-sm rounded-sm">
                                <div class="w-full">
                                    <div
                                        class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                        <span class="text-orange-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide">Produits</span>
                                    </div>
                                    <div class="px-4">
                                        <div
                                            class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
                                            @foreach ($artisanProducts as $product)
                                                <div class="group">
                                                    <div
                                                        class="w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 transition lg:h-48">
                                                        <img src="{{ str_starts_with($product->images[0], 'http') ? $product->images[0] : asset('storage/' . $product->images[0]) }}"
                                                            class="h-full w-full object-cover object-center lg:h-48">
                                                    </div>
                                                    <div
                                                        class="mt-4 flex flex-col md:flex-row md:justify-between md:items-center">
                                                        <div>
                                                            <p class="text-xs">
                                                                <x-star-rating :rating="$product->rating" />
                                                            </p>
                                                            <h3 class="md:text-sm text-xs text-gray-700">
                                                                <a href="{{ route('product.show', $product->id) }}">
                                                                    <span aria-hidden="true" class="inset-0"></span>
                                                                    {{ $product->nom }}
                                                                </a>
                                                            </h3>
                                                        </div>
                                                        <p class="md:text-sm text-xs font-medium text-gray-900">
                                                            {{ $product->prix }} DZD</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                        @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="mt-5">
        @if (auth()->id() === $user->id)
            <div class="bg-white p-4 rounded-md">

                <h1 class="text-xl font-bold mb-5 self-start">Modifier votre Profile
                </h1>
                <div class="bg-gray-100/40 shadow-md w-full p-4 mx-auto my-auto rounded-lg">
                    <form action="{{ route('profile.update', ['user' => auth()->user()]) }}" method="POST"
                        class="mb-2" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="flex md:flex-row flex-col gap-8">
                            <div class="md:w-1/2 flex flex-col gap-4">
                                <x-input name="nom" label="Nom" type="text" :value="auth()->user()->nom" />
                                <x-input name="adresse" label="Adresse" type="text" :value="auth()->user()->adresse" />
                                <x-input name="email" label="Email" type="email" :value="auth()->user()->email" />
                                @if (auth()->user() && auth()->user()->artisan)
                                    <x-textarea name="desc_entreprise" label="Description d'entreprise"
                                        type="text">{{ auth()->user()->artisan->desc_entreprise }}</x-textarea>
                                    <x-input name="heure_ouverture" label="Heure d'ouverture" type="time"
                                        :value="auth()->user()->artisan?->heure_ouverture" />
                                @endif
                            </div>
                            <div class="md:w-1/2 flex flex-col gap-4">
                                <x-input name="prenom" label="Prénom" type="text" :value="auth()->user()->prenom" />
                                <x-select name="wilaya" label="Wilaya" :list="$wilayas" :optionsValues="'wilaya_name_ascii'"
                                    :optionsSubTexts="'wilaya_code'" :optionsTexts="'wilaya_name_ascii'" :value="$user->wilaya" />

                                <x-input name="num_telephone" label="Numéro de teléphone" type="text"
                                    :value="auth()->user()->num_telephone" />
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
                                            <svg x-show="!showPassword" class="w-5 h-5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                                </path>
                                            </svg>

                                            <svg x-show="showPassword" class="w-5 h-5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
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
                                @if (auth()->user() && auth()->user()->artisan)
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
                                        :value="auth()->user()->artisan->heure_fermeture" />
                                @endif
                                @if (auth()->user() && auth()->user()->deliveryMan)
                                    <div>
                                        <label
                                            class="block text-sm font-medium leading-6 text-gray-900 mb-2">Disponible?</label>
                                        <select
                                            class="form-select w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                                            name="est_disponible" label="Êtes-vous disponible ?">
                                            <option>Choisir</option>
                                            <option value="1" @if (old('est_disponible', auth()->user()->deliveryMan->est_disponible) == true) selected @endif>
                                                Disponible
                                            </option>
                                            <option value="0" @if (old('est_disponible', auth()->user()->deliveryMan->est_disponible) == false) selected @endif>
                                                Non
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
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </template>
                                        <div class="flex text-sm text-gray-800 my-2">
                                            <label for="file-upload"
                                                class="relative cursor-pointer rounded-md font-medium text-orange-600 hover:text-orange-500">
                                                <span
                                                    class="border p-2 border-orange-500 bg-transparent hover:bg-orange-500 hover:text-white hover:rounded-md">Télécharger
                                                    une photo</span>
                                                <input id="file-upload" name="image" type="file"
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

                        <button type="submit"
                            class="bg-orange-700 hover:bg-orange-800 md:px-6 px-4 py-2 md:py-2.5 rounded-md mt-8 text-white text-sm md:text-md">
                            MODIFIER
                            VOS INFORMATIONS
                        </button>
                    </form>
                    <form method="POST" action="{{ route('profile.destroy', ['user' => $user]) }}"
                        class="flex md:justify-end" x-data="{ showModal: false }">
                        @csrf
                        @method('DELETE')
                        <!-- Modal toggle -->
                        <button type="button"
                            class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-sm md:text-md mt-5"
                            @click="showModal = true">
                            Supprimer votre compte
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
                                            <svg class="w-3 h-3" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
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
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <p class="text-base leading-relaxed text-gray-700">
                                            Vous voulez vraiment supprimer votre compte ?
                                        </p>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-center mt-6">
                                        <button type="submit"
                                            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                            @click="showModal = false">Confirmer
                                        </button>
                                        <button type="button"
                                            class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-orange-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                                            @click="showModal = false">Annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
        <div class="mx-auto w-full">
            @if (auth()->user() && auth()->user()->id !== $user->id && ($user->isArtisan() || $user->isDeliveryMan()))
                <livewire:user-review-form :user='$user' />
            @endif
            <livewire:user-review-component :user='$user' />
        </div>
    </div>
    </div>
    </div>
</x-default-layout>
