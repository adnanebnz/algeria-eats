<x-dashboard-layout :isAdmin=true>
    <div class="my-6 bg-white rounded-md p-4">
        <h4 class="text-xl text-gray-800 font-bold pb-2 mb-4 border-b-2">Message</h4>
        <div class="flex items-center justify-between">
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
