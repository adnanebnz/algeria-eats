<x-dashboard-layout :isAdmin=true>
    <div class="bg-white rounded-md shadow-lg mt-5">
        <section class="antialiased font-sans">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h2 class="text-2xl font-semibold leading-tight">Messages de contact</h2>
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Nom et prénom
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Date de création
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($messages as $message)
                                        <tr>
                                            <td class="px-5 py-5  bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10">
                                                        <img class="w-full h-full rounded-full border"
                                                            src="{{ asset('assets/user.png') }}" />
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $message->nom }}
                                                            {{ $message->prenom }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5  bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{ $message->email }}</p>
                                            </td>
                                            <td class="px-5 py-5  bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $message->created_at->format('d/m/Y') }}
                                                </p>
                                            </td>
                                            <td
                                                class="flex items-center justify-center gap-3 px-5 py-5 bg-white text-sm">
                                                <a data-tooltip-target="tooltip-see"
                                                    href="{{ route('admin.messages.show', ['message' => $message]) }}"
                                                    class="border border-solid border-gray-400  p-1 rounded-md hover:bg-blue-500 hover:text-white hover:border-transparent">
                                                    <div id="tooltip-see" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-500 rounded-lg shadow-sm opacity-0 tooltip">
                                                        Voir ce message
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('admin.messages.destroy', ['message' => $message]) }}"
                                                    x-data="{ showModal: false }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Modal toggle -->
                                                    <button type="button" data-tooltip-target="tooltip-delete"
                                                        class="border border-solid border-gray-400 p-1 rounded-md hover:bg-red-500 hover:text-white hover:border-transparent"
                                                        @click="showModal = true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <div id="tooltip-delete" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-500 rounded-lg shadow-sm opacity-0 tooltip">
                                                        Supprimer ce message
                                                    </div>
                                                    <div x-show="showModal" x-cloak
                                                        class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center">
                                                        <!-- Black background overlay -->
                                                        <div class="absolute inset-0 bg-black opacity-50">
                                                        </div>
                                                        <!-- Modal container -->
                                                        <div x-show="showModal" x-cloak
                                                            x-transition:enter="transition ease-out duration-300"
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
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="space-y-4">
                                                                    <svg class="mx-auto mb-4 text-gray-400 w-14 h-14"
                                                                        aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 20 20">
                                                                        <path stroke="currentColor"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                    </svg>
                                                                    <p class="text-base leading-relaxed text-gray-700">
                                                                        Vous voulez vraiment supprimer ce message ?
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
                                                                <div id="tooltip-delete" role="tooltip"
                                                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-500 rounded-lg shadow-sm opacity-0 tooltip">
                                                                    Supprimer ce message
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-5 py-5 bg-white text-sm text-center">
                                                Aucun message trouvé.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="my-5">
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-dashboard-layout>
