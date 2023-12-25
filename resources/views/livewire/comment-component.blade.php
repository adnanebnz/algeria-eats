<div class="mt-10">
    @if ($comments->count() > 0)
        <h2 class="px-4 pt-3 pb-2 text-gray-800 text-xl">Les évaluations</h2>
    @endif
    <div class="flex flex-col gap-3.5">
        @foreach ($comments as $comment)
            <div class="w-full flex justify-center items-center shadow-sm">
                <div class="flex flex-col justify-start items-start w-full space-y-8">
                    <div class="w-full flex justify-start items-start flex-col bg-gray-50 p-8">
                        <div id="menu" class="md:block">
                            <div class="mt-6 flex justify-start items-center flex-row space-x-2.5">
                                <div>
                                    <img class="h-10 w-10 object-cover rounded-full border"
                                         src="{{ $comment->user->image ? (str_starts_with($comment->user->image, 'http') ? $comment->user->image : asset('storage/' . $comment->user->image)) : asset('assets/user.png') }}"
                                         alt="avatar"/>
                                </div>
                                <div class="flex flex-col justify-start items-start space-y-2">
                                    <p class="text-base font-medium leading-none text-gray-800">
                                        {{ $comment->user->getFullName() }}
                                    </p>
                                    <p class="text-sm leading-none text-gray-600">
                                        {{ strftime('%e %B %Y', strtotime($comment->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex justify-start items-start flex-col bg-gray-50 md:px-8 py-8">
                            <div class="flex flex-col md:flex-row justify-between w-full">
                                <div class="flex flex-row justify-between items-start">
                                    <p class="text-xl md:text-2xl font-medium leading-normal text-gray-800">
                                        {{ $comment->title }}</p>
                                </div>
                                <div class="cursor-pointer mt-2 md:mt-0 text-lg">
                                    <x-star-rating :rating="$comment->rating"/>
                                </div>
                            </div>
                            <div id="menu2" class="hidden md:block">
                                <p class="mt-3 text-base leading-normal text-gray-600 w-full">
                                    {{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
