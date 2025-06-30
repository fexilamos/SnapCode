<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="font-mono">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="font-mono" />
            <x-text-input id="email" class="block mt-1 w-full font-mono" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 font-mono" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-mono" />

            <x-text-input id="password" class="block mt-1 w-full font-mono"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 font-mono" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center font-mono">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-white font-mono">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-6">
            <button type="submit" class="ms-3 px-6 py-2 bg-sky-800 hover:bg-slate-700 text-white rounded font-mono font-semibold shadow transition-all duration-200">
                {{ __(' Login') }}
            </button>
        </div>
    </form>
</x-guest-layout>
