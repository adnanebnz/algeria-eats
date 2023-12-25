<div x-data="{ rating: @entangle('rating') }">
    <div class="flex items-center justify-center shadow-lg mt-16 mb-4 w-full">
        <form class="w-full bg-white rounded-lg px-4 pt-2" wire:submit='store()'>
            <div class="flex flex-col -mx-3 mb-6">
                <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Ajouter une nouvelle évaluation</h2>
                <div class="w-full px-3 mb-2 mt-2">
                    <input wire:model="title"
                        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-10 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white mb-4"
                        name="title" placeholder='Titre' required />
                    <textarea wire:model="review"
                        class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                        name="body" placeholder='Votre évaluation' required></textarea>
                    <div>
                        <div class="w-auto h-auto inline-block mt-3" x-on:click="rating = $event.target.dataset.rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i data-rating="{{ $i }}"
                                    x-bind:class="{
                                        'fas fa-star text-yellow-400 hover:text-yellow-500 text-2xl': rating >=
                                            {{ $i }},
                                        'far fa-star text-yellow-400 hover:text-yellow-500 text-2xl': rating <
                                            {{ $i }}
                                    }"
                                    class="cursor-pointer"></i>
                            @endfor
                        </div>
                        <input id="rating" name="rating" type="hidden" wire:model="rating">
                        @error('rating')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="w-full flex items-start md:w-full px-3 mt-2">
                    <div class="-mr-1">
                        <button type='submit'
                            class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100">Envoyer
                            l'évaluation</button>
                    </div>
                </div>
        </form>
    </div>
</div>
