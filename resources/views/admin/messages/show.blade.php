<x-dashboard-layout :isAdmin=true>
    <div class="my-6 bg-white rounded-md p-4">
        <div class="flex items-center justify-between">
            <h4 class="text-xl text-gray-800 font-bold pb-2 mb-4 border-b-2">Message</h4>

            <form method="POST" action="{{ route('admin.messages.destroy', ['message' => $message]) }}"
                x-data="{ showModal: false }">
                @csrf
                @method('DELETE')
                <!-- Modal toggle -->
                <button type="button" class="bg-red-500 text-white px-3 py-1.5 rounded-md hover:bg-red-700"
                    @click="showModal = true">
                    Supprimer
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
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="space-y-4">
                                <svg class="mx-auto mb-4 text-gray-400 w-14 h-14" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
        </div>
        <div class="flex items-center justify-between mt-5">
            <div class="flex items-center">
                <img src={{ asset('assets/user.png') }} class="rounded-full w-8 h-8 border border-gray-500">
                <div class="flex flex-col ml-2">
                    <span class="text-sm font-semibold">{{ $message->nom }} {{ $message->prenom }}</span>
                    <span class="text-xs text-gray-400">De: {{ $message->email }}</span>
                </div>
            </div>
            <span class="text-sm text-gray-500">{{ $message->created_at->format('d/m/Y') }}</span>
        </div>
        <div class="py-6 pl-2 text-gray-700">
            <p>{{ $message->message }}</p>
        </div>
    </div>
    </div>
</x-dashboard-layout>
