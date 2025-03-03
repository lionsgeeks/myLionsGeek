<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex w-full gap-9 h-full bg-[#2E2E2E] pr-10 rounded-lg">
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <div class="flex flex-col items-center rounded-lg justify-center gap-7 w-[62vw] p-8">
        <dotlottie-player src="https://lottie.host/0da8275c-bf35-42c4-8b15-d8e3787ccd37/O6JB496Rd1.lottie" background="transparent" speed="1" style="width: 350px; height: 400px" loop autoplay></dotlottie-player>


    </div>

    <div class="w-[50vw] m-auto pr-10">
        <div class="mb-8 flex flex-col justify-center items-center">
            <img src="https://mylionsgeek.ma/logo1.png" alt="logo" class="w-[80px] h-[80px] invert mb-3"
            loading="lazy">
            <h1 class="text-3xl text-white mb-2">Welcome</h1>
            <h4 class="text-gray-400 font-light text-lg">Please Enter Your Information</h4>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 ">
                <x-input-label class="text-gray-400" for="password" :value="__('Password')" />

                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full "
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->

            <div class="flex items-center justify-between mt-4 mb-10">
                <div class="block mt-2">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-alpha rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

            </div>
            <x-primary-button class=" w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </form>
    </div>
</div>
