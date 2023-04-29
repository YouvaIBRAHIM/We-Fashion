<x-guest-layout>
    <div class="formContainer">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <h2>Mot de passe oublié ?</h2>

        <form method="POST" action="{{ route('password.email') }}" class="form">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"  class="input" type="email" name="email" :value="old('email')" required autofocus />
                <div class="errors">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Réinitialiser le mot de passe') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</x-guest-layout>
