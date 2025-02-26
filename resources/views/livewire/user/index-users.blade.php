<div class="mt-8">

    <div class="flex justify-end">
        <button wire:click="toggleModal" class="py-2 px-4 bg-[#fee814] rounded-lg">+ Add User</button>
    </div>
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold mb-4 text-[#fee814] border-b pb-2 w-full">All Members</h2>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div
                class="bg-gray-900 rounded-lg p-6 w-[90%] max-w-lg shadow-2xl transform transition-transform duration-300 scale-100">
                <h2 class="text-xl font-bold mb-4 text-[#fee814] border-b pb-2">Add Computer</h2>
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name:</label>
                        <input type="text" wire:model="userForm.name" id="name" placeholder="Full Name"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                        @error('userForm.name')
                            <em class="text-red-600">{{ $message }}</em>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email:</label>
                        <input type="email" wire:model="userForm.email" id="email" placeholder="Email"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                        @error('userForm.email')
                            <em class="text-red-600">{{ $message }}</em>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Phone:</label>
                        <input type="number" wire:model="userForm.phone" id="phone" placeholder="Phone Number"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                        @error('userForm.phone')
                            <em class="text-red-600">{{ $message }}</em>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="cin" class="block text-sm font-medium text-gray-300 mb-1">CIN:</label>
                        <input type="text" wire:model="userForm.cin" id="cin" placeholder="CIN"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                        @error('userForm.cin')
                            <em class="text-red-600">{{ $message }}</em>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Role:</label>
                        <select wire:model="userForm.role" id="role"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                            <option disabled>Select Role</option>
                            <option value="Moderator">Moderator</option>
                            <option value="Coworker">Coworker</option>
                            <option value="Student">Student</option>
                        </select>
                        @error('userForm.role')
                            <em class="text-red-600">{{ $message }}</em>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Select
                            Status:</label>
                        <select wire:model="userForm.status" id="status"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                            <option disabled>Select Status</option>
                            <option value="Studying">Studying</option>
                            <option value="Working">Working</option>
                            <option value="Internship">Internship</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Freelancing">Freelancing</option>
                        </select>
                        @error('userForm.status')
                            <em class="text-red-600">{{ $message }}</em>
                        @enderror
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="cancel"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#fee814] text-black rounded-lg hover:bg-yellow-400 transition-colors duration-300">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div x-data="" class=" flex flex-col gap-3">
        <div class="mb-4 flex justify-end gap-3">
            <input type="text" wire:model.live='search' placeholder="Search" class="border border-gray-600 p-2 rounded-lg w-full md:w-1/6 bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none placeholder:text-sm">           
            <select  wire:model.live="roleQuery" class="border border-gray-600 p-2 rounded-lg w-full text-sm md:w-[8.5vw] bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">               
                <option disabled selected>Select Role</option>
                <option value="Moderator">Moderator</option>
                <option value="Coworker">Coworker</option>
                <option value="Student">Student</option>
            </select>
            <select class="border border-gray-600 p-2 rounded-lg w-full text-sm md:w-[8.5vw] bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" wire:model.live="statusQuery">
                <option disabled selected>Select Status</option>
                <option value="Studying">Studying</option>
                <option value="Working">Working</option>
                <option value="Internship">Internship</option>
                <option value="Unemployed">Unemployed</option>
                <option value="Freelancing">Freelancing</option>
            </select>
            <button wire:click='resetFilters()' class="bg-[#fee814] text-black px-3 py-2 rounded-lg hover:bg-yellow-400 transition-colors duration-300" >Reset Filters</button>
        </div>
        <div class="container mx-auto h-full">
            <div class="">
                <table class="min-w-full bg-gray-900 border border-gray-700">
                    <thead class="">
                        <tr class="bg-[#2E2E2E] text-white text-sm ">
                            <th class="py-2 px-4 border border-gray-700">Image</th>
                            <th class="py-2 px-4 border border-gray-700">Full Name</th>
                            <th class="py-2 px-4 border border-gray-700">Email</th>
                            <th class="py-2 px-4 border border-gray-700">Role</th>
                            <th class="py-2 px-4 border border-gray-700">Status</th>
                            <th class="py-2 px-4 border border-gray-700">Details</th>
                            <th class="py-2 px-4 border border-gray-700">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="{{ $loop->even ? 'bg-[#2E2E2E]' : 'bg-[#454545]' }} text-white">
                                <td class="text-center py-2 px-4 border border-gray-600">
                                    <img src="" alt="">
                                </td>
                                <td class="text-center py-2 px-4 border border-gray-600">{{ $user->name }}</td>
                                <td class="text-center py-2 px-4 border border-gray-600">{{ $user->email }}</td>
                                <td class="text-center py-2 px-4 border border-gray-600">{{ $user->access?->role }}</td>
                                <td class="text-center py-2 px-4 border border-gray-600">{{ $user->status }}</td>
                                <td class="text-center py-2 px-4 border border-gray-600">
                                    <a wire:navigate class="flex justify-center" href="/user/{{ $user->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                </td>
                                <td class="text-center py-2 px-4 border border-gray-600">
                                    <button class="text-red-500" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete{{ $user->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            {{-- Modal de confirmation de suppression --}}
                            <div class="flex justify-center">
                                <x-modal name="confirm-user-delete{{ $user->id }}" :show="$errors->isNotEmpty()">
                                    <div class="p-5 gap-2 flex flex-col items-center">
                                        <h1>Are you sure about that?</h1>
                                        <div>
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>
                                            <button class="bg-red-500 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm"
                                                wire:click='delete("{{ $user->id }}")'>Delete</button>
                                        </div>
                                    </div>
                                </x-modal>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- <button class="text-red-500"
            x-on:click.prevent="$dispatch('open-modal', 'create_user')">{{ __('Create User') }}</button>
        <x-modal name="create_user" :show="$errors->isNotEmpty()">
            <livewire:user.create-user />
        </x-modal> --}}
    </div>
</div>
