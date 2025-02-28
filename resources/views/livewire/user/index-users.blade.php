<div class="mt-6 px-5">

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
        <div class=" flex justify-end gap-3">
            <input type="text" wire:model.live='search' placeholder="Search"
                class="border border-gray-600 p-2 rounded-lg w-full md:w-1/6 bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none placeholder:text-sm">
            <select wire:model.live="roleQuery"
                class="border border-gray-600 p-2 rounded-lg w-full text-sm md:w-[8.5vw] bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                <option disabled selected>Select Role</option>
                <option value="Moderator">Moderator</option>
                <option value="Coworker">Coworker</option>
                <option value="Student">Student</option>
            </select>
            <select
                class="border border-gray-600 p-2 rounded-lg w-full text-sm md:w-[8.5vw] bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none"
                wire:model.live="statusQuery">
                <option disabled selected>Select Status</option>
                <option value="Studying">Studying</option>
                <option value="Working">Working</option>
                <option value="Internship">Internship</option>
                <option value="Unemployed">Unemployed</option>
                <option value="Freelancing">Freelancing</option>
            </select>
            <button wire:click='resetFilters()'
                class="bg-[#fee814] text-black px-3 py-2 rounded-lg hover:bg-yellow-400 transition-colors duration-300">Reset
                Filters</button>
        </div>
        <div class="container mx-auto h-full">
            <div class="">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#2E2E2E] text-white text-sm ">
                            <th></th>
                            <th class="py-2 px-4">Image</th>
                            <th class="py-2 px-4">Full Name</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Role</th>
                            <th class="py-2 px-4">Status</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-700 text-white">
                                <td class="px-3"><i class="fa-solid fa-grip text-gray-500"></i></td>
                                <td class="px-5  text-center">
                                    <img src="" alt="" class="w-8 h-8 rounded-full">
                                </td>
                                <td class="px-3">{{ $user->name }}</td>
                                <td class="px-3">{{ $user->email }}</td>
                                <td class="px-3">{{ $user->access?->role }}</td>
                                <td
                                    class="px-3 text-sm font-semibold 
                                {{ $user->status == 'Studying'
                                    ? 'text-[#d4f1f4]'
                                    : ($user->status == 'Working'
                                        ? 'text-[#7ada31]'
                                        : ($user->status == 'Internship'
                                            ? 'text-[#fee814]'
                                            : ($user->status == 'Unemployed'
                                                ? 'text-red-500'
                                                : ($user->status == 'Freelancing'
                                                    ? 'text-[#f8946d]'
                                                    : 'text-gray-700')))) }}">
                                    {{ ucfirst($user->status) }}
                                </td>

                                <td class="px-3  space-x-2">
                                    <a wire:navigate href="/user/{{ $user->id }}" class="text-gray-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button"
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete{{ $user->id }}')">
                                        🗑
                                    </button>
                                </td>
                            </tr>

                            <div class="flex justify-center">
                                <x-modal name="confirm-user-delete{{ $user->id }}" :show="$errors->isNotEmpty()"
                                    x-on:close-modal.window="$dispatch('close')">
                                    <div class="p-5 gap-2 flex flex-col items-center">
                                        <h1>Are you sure about that?</h1>
                                        <div>
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>
                                            <button
                                                class="bg-red-500 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm"
                                                wire:click='delete("{{ $user->id }}")'>Delete</button>
                                        </div>
                                    </div>
                                </x-modal>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-3">
                {{ $users->links() }}
            </div>
        </div>

        {{-- <button class="text-red-500"
            x-on:click.prevent="$dispatch('open-modal', 'create_user')">{{ __('Create User') }}</button>
        <x-modal name="create_user" :show="$errors->isNotEmpty()">
            <livewire:user.create-user />
        </x-modal> --}}
    </div>
</div>
