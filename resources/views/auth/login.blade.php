<x-auth-layout title="Se Connecter" :action="route('login')" submitMessage="Connexion" page="login">
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
                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                    </path>
                </svg>

                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" style="display: none;">
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

    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox"
                class="form-checkbox h-4 w-4 rounded border-gray-300 text-orange-600 focus:ring-orange-600">
            <label for="remember" class="ml-3 block text-sm leading-6 text-gray-900">Rester Connecter</label>
        </div>
        <div class="text-sm">
            <a href="{{ route('password.request') }}"
                class="font-medium text-orange-600 hover:text-orange-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                Mot de passe oublié ?
            </a>
        </div>
    </div>
</x-auth-layout>
