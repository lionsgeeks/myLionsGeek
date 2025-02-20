<div class="p-10 bg-gray-100 ">
    <div class="grid grid-cols-2 gap-10 px-[3vw]">
        <div
            class="flex flex-col items-center justify-center border-dashed border-2 border-gray-400 h-72 bg-gray-50 rounded-lg hover:border-gray-600 transition-colors">
            <button wire:click="$set('showModal', true)" class="text-gray-700 text-3xl font-bold">+</button>
            <span class="text-gray-600 font-medium mt-2">
                @if ($updateData == false)
                    Add Formation
                @else
                    Edit Formation
                @endif
            </span>
        </div>

        @foreach ($formations as $formation)
        <div wire:key="{{ $formation->id }}" class="relative rounded-lg h-72 overflow-hidden shadow-md bg-gray-300 transition-transform transform hover:scale-105 hover:shadow-lg">
            <!-- Image -->
            <img src="https://via.placeholder.com/300" alt="Formation Image" class="h-full w-full object-cover">
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 via-gray-800 to-transparent p-4 rounded-b-lg">
                <h3 class="text-white font-semibold text-xl mb-1">{{ $formation->class_name }}</h3>
                <p class="text-gray-300 text-sm mb-1">{{ $formation->formation_name }}</p>
                <div class="text-gray-400 text-xs space-y-1">
                    <p>📅 Start: <span class="text-gray-200">{{ $formation->start_time }}</span></p>
                    <p>⏰ End: <span class="text-gray-200">{{ $formation->end_time }}</span></p>
                </div>
            </div>
        
            <!--  Icons -->
            <div class="absolute flex top-4 right-4 space-x-3 cursor-pointer">
                <!-- Delete  -->
                <svg wire:click="delete({{ $formation->id }})" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="h-6 w-6 text-gray-400 hover:text-red-600 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                <!-- Edit  -->
                <svg wire:click="edit({{ $formation->id }})" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="h-6 w-6 text-gray-400 hover:text-blue-600 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </div>
        </div>
        
        @endforeach
    </div>

    @if ($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center ">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    @if ($updateData == false)
                        🎓 Add Formation
                    @else
                        🎓 Edit Formation
                    @endif
                </h2>
                <form class="space-y-6" wire:submit="formation">
                    <div>
                        <label for="class_name" class="block text-sm font-medium text-gray-700">Class Name</label>
                        <input type="text" id="class_name" wire:model="class_name" placeholder="Enter Class Name"
                            class="mt-2 p-3 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    </div>
                    <div>
                        <label for="formation_name" class="block text-sm font-medium text-gray-700">Formation
                            Name
                        </label>
                        <select id="formation_name" wire:model="formation_name"
                            class="mt-2 p-3 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                            <option selected disabled>Select Formation</option>
                            <option value="Coding">Coding</option>
                            <option value="Media">Media</option>
                        </select>
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                        <input type="date" id="start_time" wire:model="start_time"
                            class="mt-2 p-3 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                        <input type="date" id="end_time" wire:model="end_time"
                            class="mt-2 p-3 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                    </div>
                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="cancel"
                            class="px-4 py-2 bg-gray-700 hover:bg-gray-700/85 text-white rounded-lg">Cancel</button>
                        @if ($updateData == false)
                            <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-500/85 text-white rounded-lg">Create</button>
                        @else
                            <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-500/85 text-white rounded-lg">Update</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
