<x-app-layout>
    <div class="py-12 bg-[#171717] min-h-screen">
        <div class="w-[92vw] mx-auto sm:px-6 lg:px-8">
            <div class="bg overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-1 text-gray-900">
                   <livewire:computer.create-computer />
                </div>
                <div>
                    <livewire:computer.show-computers >
                </div>
            </div>
        </div>
    </div>
</x-app-layout>