<div>
    <div x-data="" class="py-12 flex flex-col gap-3">
        <div class="grid grid-cols-[2fr_1fr_1fr_0.5fr] gap-3 ">
            <input type="text" wire:model.live='search' placeholder="Search" class="p-2 rounded">
            <select class="rounded" wire:model.live="roleQuery">
                <option disabled selected>Select Role</option>
                <option value="Moderator">Moderator</option>
                <option value="Coworker">Coworker</option>
                <option value="Student">Student</option>
            </select>
            <select class="rounded" wire:model.live="statusQuery">
                <option disabled selected>Select Status</option>
                <option value="Studying">Studying</option>
                <option value="Working">Working</option>
                <option value="Internship">Internship</option>
                <option value="Unemployed">Unemployed</option>
                <option value="Freelancing">Freelancing</option>
            </select>
            <button wire:click='resetFilters()' class="bg-black text-white rounded font-medium">Reset Filters</button>
        </div>
        <table class="bg-white">
            <thead class="border border-black/30">
                <tr class="bg-gray-400">
                    <th class="py-2">Image</th>
                    <th class="py-2">Full Name</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Role</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">Details</th>
                    <th class="py-2">Delete</th>
                    {{-- <th>Update</th> --}}
                </tr>
            </thead>
            <tbody class="border-r border-l border-black/30">
                @foreach ($users as $user)
                    <tr wire:key='{{ $user->id }}' class="border-b h-12 border-black/30">
                        <td class="text-center"><img src="" alt=""></td>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->access?->role }}</td>
                        <td class="text-center">{{ $user->status }}</td>
                        <td class="text-center"><a wire:navigate class="flex justify-center"
                                href="/user/{{ $user->id }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a></td>
                        <td class="text-center">
                            <button class="text-red-500"
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-delete{{ $user->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </td>
                        {{-- <td>
                            <button class="text-blue-500"
                                    x-on:click.prevent="$dispatch('open-modal', 'update-user{{ $user->id }}')">{{ __('Update User') }}</button>
                                <x-modal name="update-user{{ $user->id }}" :show="$errors->isNotEmpty()">
                                    <div class="p-5 gap-2 flex flex-col items-center">
                                        <h1>Update User</h1>
                                        <div>
                                            <livewire:user.update-user :user="$user">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Cancel') }}
                                                </x-secondary-button>
                                        </div>
                                    </div>
                                </x-modal>
                        </td> --}}
                    </tr>
                    {{-- modal delete --}}
                    <div class="flex justify-center">
                        <x-modal name="confirm-user-delete{{ $user->id }}" :show="$errors->isNotEmpty()">
                            <div class="p-5 gap-2 flex flex-col items-center">

                                <h1>Are you sure about that ?</h1>
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
        {{-- <button class="text-red-500"
            x-on:click.prevent="$dispatch('open-modal', 'create_user')">{{ __('Create User') }}</button>
        <x-modal name="create_user" :show="$errors->isNotEmpty()">
            <livewire:user.create-user />
        </x-modal> --}}
    </div>
</div>
