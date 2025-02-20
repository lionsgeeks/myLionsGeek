<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="p-8 w-full">
        <div class="flex items-center justify-between">
            <p class="text-2xl font-bold">All Members</p>
            <button class="px-3 py-2 self-end bg-yellow-400 rounded"><a href="/addusers">Add User</a> </button>
        </div>
        <livewire:user.index-users/>
    </div>
</x-app-layout>
