<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <livewire:user.update-user :user="$user">
    </div>
</x-app-layout>
