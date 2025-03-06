    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>myLionsGeek</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen  bg-gray-100">
            <main class="bg-dark justify-center flex flex-col gap-3 items-center min-h-screen">
                @if (!$user->password)
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    <livewire:user.set-password :user="$user">
                    @else
                        <div class="w-[50%] bg-gray-900 rounded-lg p-6 shadow-2xl text-gray-300 text-center">
                            <p class="text-xl">You already have a password set. </p>
                            <a href="/login">
                                <button class="bg-alpha px-4 py-2 rounded-lg font-medium text-black mt-3">
                                    Login
                                </button>
                            </a>
                        </div>
                @endif
            </main>
        </div>
    </body>

    </html>
