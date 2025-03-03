<div class="bg-dark p-10">
    <div class="ml-[2vw] mb-12 flex gap-3">
        <input type="text" wire:model.live='searchName' placeholder="Search by Name" class="rounded ">
        <select name="searchType" id="searchType" wire:model.change='searchType' class="rounded">
            <option value="" selected>Select Type</option>
            <option value="studios">Studios</option>
            <option value="co_work">Co-Work</option>
            <option value="meeting_room">Meeting Room</option>
        </select>
        <select name="searchState" id="searchState" wire:model.change='searchState' class="rounded">
            <option value="" selected>Select State</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        <button wire:click='resetting' class="bg-alpha text-black p-2 rounded">
            Reset Filters
        </button>
    </div>
    <div class="grid grid-cols-3 gap-10 px-[2vw]">
        <div wire:click="$set('showModal', true)"
            class="flex flex-col items-center justify-center border-dashed border-2 border-white h-[20.9rem] bg-dark rounded-lg hover:shadow-lg transition-shadow duration-300">
            <button class="text-white text-4xl font-bold hover:scale-110 transition-transform duration-300">+</button>
            <span class="text-white mt-2 text-lg font-medium">Add Place</span>
        </div>


        @foreach ($this->places as $place)
            <div class="rounded-lg overflow-hidden  shadow-xl hover:shadow-xl transition-shadow duration-300">
                <div class="relative">
                    @foreach ($place->images as $image)
                        {{-- tempo fix before carousel --}}
                        @if ($loop->iteration == 1)
                            <img class="rounded-t-lg w-full h-60 object-cover"
                                src="{{ asset('storage/images/places/' . $image->path) }}" alt="">
                        @endif
                    @endforeach
                    <h1
                        class="absolute top-2 right-3 capitalize px-3 py-1 rounded-lg bg-[#fee7147c] text-white text-sm font-semibold">
                        {{ str_replace('_', ' ', $place->place_type) }}
                    </h1>
                </div>
                <div class="flex justify-between items-center bg-[#2E2E2E] p-4 rounded-b-lg">
                    <div>
                        <h1 class="text-white text-lg font-semibold">{{ $place->name }}</h1>
                        <a href="#" class="block text-alpha mt-2 text-sm hover:underline">See Gallery</a>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <button class="text-gray-500 px-2 py-1 hover:text-blue-700 transition-colors duration-300"
                            wire:click="edit({{ $place->id }})">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button wire:click="delete({{ $place->id }})"
                            class="text-gray-500 hover:text-red-700 transition-colors duration-300">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div
                class="bg-gray-900 rounded-lg p-6 w-[90%] max-w-lg shadow-2xl transform transition-transform duration-300 scale-100">
                <h2 class="text-xl font-bold mb-4 text-alpha border-b pb-2">Add a Place</h2>
                <form enctype="multipart/form-data" wire:submit.prevent="add">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name:</label>
                        <input type="text" wire:model="name" id="name" placeholder="Nom"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none" />
                    </div>
                    <div class="mb-4">
                        <label for="place_type" class="block text-sm font-medium text-gray-300 mb-1">Places:</label>
                        <select wire:model="place_type" id="place_type"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                            <option value="">-- Select Type --</option>
                            <option value="studios">Studios</option>
                            <option value="meeting_room">Meeting room</option>
                            <option value="co_work">Co-work</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="state" class="block text-sm font-medium text-gray-300 mb-1">State:</label>
                        <select wire:model="state" id="state"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-1">Image:</label>
                        <input type="file" multiple wire:model="image" id="image"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-alpha focus:outline-none" />
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="cancel"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            Cancel
                        </button>

                        @if (!$selectedPlaceId)
                            <button type="submit"
                                class="px-4 py-2 bg-alpha text-black rounded-lg hover:bg-yellow-400 transition-colors duration-300">
                                Create
                            </button>
                        @else
                            <button type="submit"
                                class="px-4 py-2 bg-alpha text-black rounded-lg hover:bg-yellow-400 transition-colors duration-300">
                                Update
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
