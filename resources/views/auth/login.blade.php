<x-guest-layout>
    <div class="formContainer">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <h2>Connexion</h2>
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            <!-- Email Address -->
            <div>
                <x-text-input id="email" class="input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
                <div class="errors">
                    <x-input-error :messages="$errors->get('email')" />
                </div>
            </div>
    
            <!-- Password -->
            <div>
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                class="input"
                                required autocomplete="current-password" />
    
                <div class="errors">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>                
            </div>
    
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a  id="forgotPassword" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
    
                <x-primary-button class="ml-3">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
