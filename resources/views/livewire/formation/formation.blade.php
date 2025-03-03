<div class="p-10  bg-[#171717] min-h-screen">

    <!-- Search  -->
    <div id="search" class="relative pb-8 w-full max-w-md ml-12 ">
        <input
            wire:model.live.debounce.500ms="search"
            type="text"
            placeholder="Search by formations..."
            class="border border-gray-600 p-2 rounded-lg w-full pl-12 bg-[#2E2E2E] text-white focus:ring-2 focus:ring-alpha focus:outline-none placeholder:text-sm">

            <svg class="absolute left-4 top-3 w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10A7 7 0 1110 3a7 7 0 017 7z" />
        </svg>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-[3vw]">
        <!-- Add Formation  -->
        <div class="flex flex-col items-center justify-center border-dashed border-2 border-white h-75 rounded-lg hover:border-gray-600 transition-colors cursor-pointer hover:shadow-md"
             wire:click="$set('showModal', true)">
            <button class="text-white text-4xl font-bold">+</button>
            <span class="text-white font-medium mt-2">
                {{ $updateData ? 'Edit Formation' : 'Add Formation' }}
            </span>
        </div>

        <!-- Formation Cards -->
        @foreach ($formations as $formation)
        <div wire:key="{{ $formation->id }}" class="relative rounded-lg h-72 overflow-hidden shadow-md  hover:shadow-xl transition-all transform hover:scale-105">
            <img src="https://via.placeholder.com/300" alt="Formation Image" class="h-full w-full object-cover">
            <div class="absolute bottom-0 left-0 right-0 bg-[#2E2E2E]  p-5 rounded-b-lg">
                <h3 class="text-alpha font-semibold text-lg">{{ $formation->class_name }}</h3>
                <p class="text-gray-300 text-sm">{{ $formation->formation_name }}</p>
                <div class="text-gray-400 text-xs space-y-1 mt-2">
                    <p>📅 Start: <span class="text-gray-200">{{ $formation->start_time }}</span></p>
                    <p>⏰ End: <span class="text-gray-200">{{ $formation->end_time }}</span></p>
                </div>
            </div>

            <div class="absolute flex top-4 right-4 space-x-3 cursor-pointer">
                <svg wire:click="delete('{{ $formation->id }}')"xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="h-6 w-6 text-gray-400 hover:text-red-600 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <svg wire:click="edit('{{ $formation->id }}')" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="h-6 w-6 text-gray-400 hover:text-blue-600 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $formations->links() }}
    </div>

    <!-- Modal -->
    @if ($showModal)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center">
        <div class="bg-gray-900 rounded-lg shadow-lg p-8 max-w-md w-full">
            <h2 class="text-xl font-bold mb-4 text-alpha border-b pb-2">
                {{ $updateData ? 'Edit Formation' : 'Add Formation' }}
            </h2>
            <form class="space-y-6" wire:submit="formation">
                <div>
                    <label class="lock text-sm font-medium text-gray-300 ">Class Name :</label>
                    <input type="text" wire:model="class_name" placeholder="Enter Class Name"
                        class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                </div>
                <div>
                    <label class="lock text-sm font-medium text-gray-300 ">Formation Name :</label>
                    <select wire:model="formation_name"
                        class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                        <option selected disabled value="">Select Formation</option>
                        <option value="Coding">Coding</option>
                        <option value="Media">Media</option>
                    </select>
                </div>
                <div class="flex space-x-4">
                    <div>
                        <label class="lock text-sm font-medium text-gray-300 " for="">start :</label>
                        <input type="date" wire:model="start_time" class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                    </div>
                    <div>
                        <label class="lock text-sm font-medium text-gray-300 " for="">End :</label>
                        <input type="date" wire:model="end_time" class="w-full mt-1 border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" wire:click="cancel" class="px-4 py-2 bg-gray-700 text-white rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">{{ $updateData ? 'Update' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
