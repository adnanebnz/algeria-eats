<x-auth-layout :action="route('password.update')" title="Mot de passe oublié" submitMessage="Modifier votre mot de passe">

    <div>
        <div class="flex justify-center">
            <div class="w-full">
                <div>
                    <div class="mb-6 text-xl font-bold text-center text-gray-800">{{ __('Reset Password') }}</div>

                    @if (session('status'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-2">
                            Email
                        </label>
                        <input id="email" type="email"
                            class="w-full p-2 border border-gray-300 rounded @error('email') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent focus:transition-all"
                            name="email" value="{{ $email }}" required autocomplete="email" autofocus>

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-medium mb-2">
                            Mot de passe
                        </label>
                        <input id="password" type="password"
                            class="w-full p-2 border border-gray-300 rounded @error('password') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent focus:transition-all"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-2">
                            Confirmer le mot de passe
                        </label>
                        <input id="password_confirmation" type="password"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent focus:transition-all"
                            name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
