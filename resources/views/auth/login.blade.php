<x-auth-layout>
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-block">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="input-block">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="input-block remember-me-wrapper">
            <label for="remember-me">
                <input id="remember-me" type="checkbox" name="remember">
                <span class="remember-me">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="password-wrapper">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-auth-layout>
