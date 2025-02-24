<div>
    <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition"
        x-on:click.prevent="$dispatch('open-modal', 'modal' )">{{ __('create equipment') }}</button>
    <x-modal name="modal" :show="$errors->isNotEmpty()">
        <div class="p-5 gap-2 flex flex-col items-center">
            <form wire:submit='create' class="flex flex-col items-center">
                <label class="flex flex-col gap-y-2">
                    <span>reference :</span>
                    <input type="text" wire:model="reference">
                    @error('reference')
                        <em class="text-red-500">{{ $message }}</em>
                    @enderror
                </label>

                <label class="flex flex-col gap-y-2">
                    <span>mark :</span>
                    <input type="text" wire:model="mark">
                    @error('mark')
                        <em class="text-red-500">{{ $message }}</em>
                    @enderror
                </label>

                <label class="flex flex-col gap-y-2">
                    <span>equipment_type :</span>
                    <select wire:model="equipment_type">
                        <option selected hidden>choose equipment type</option>
                        <option value="camera">camera</option>
                        <option value="son">son</option>
                        <option value="lumiere">lumiere</option>
                        <option value="data/stockage">data/stockage</option>
                        <option value="podcast">podcast</option>
                        <option value="other">other</option>
                    </select>
                    @error('equipment_type')
                        <em class="text-red-500">{{ $message }}</em>
                    @enderror
                </label>
                    <input type="file" wire:model="image">
                    @error('image')
                        <em class="text-red-500">{{ $message }}</em>
                    @enderror
                    @if ($image)
                        <img width="250" src="{{ $image->temporaryUrl() }}">
                    @endif
                <div>
                    <button wire:click="cancel" type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="text-white bg-blue-500 mt-2 p-3 rounded-lg">Create</button>
                </div>
            </form>
        </div>
    </x-modal>

    <input type="text" wire:model.live="search" placeholder="search">
    <select wire:model.live="equipmentType">
        <option disabled>choose equipment type</option>
        <option value="camera">camera</option>
        <option value="son">son</option>
        <option value="lumiere">lumiere</option>
        <option value="data/stockage">data/stockage</option>
        <option value="podcast">podcast</option>
        <option value="other">other</option>
    </select>
    <button wire:click="resetSearch">reset</button>

    <table>
        <thead>
            <tr>
                <th>image</th>
                <th>Reference</th>
                <th>Mark</th>
                <th>State</th>
                <th>Equipment Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipments as $equipment)
                <tr wire:key="{{ $equipment->id }}">
                    <td>
                        @foreach ($equipment->images as $image)
                            <img width="100" src="{{ asset('storage/' . $image->path) }}" alt="" >
                        @endforeach
                        {{-- @if ($equipment->images->isNotEmpty())
                            <img width="100" src="{{ asset('storage/' . $equipment->images->first()->path ) }}" alt="">
                        @endif --}}
                    </td>
                    <td>{{ $equipment->reference }}</td>
                    <td>{{ $equipment->mark }}</td>
                    <td>{{ $equipment->state }}</td>
                    <td>{{ $equipment->equipment_type }}</td>
                    <td>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                            x-on:click.prevent="$dispatch('open-modal', 'delete-equipment{{ $equipment->id }}')">{{ __('delete') }}</button>
                        <x-modal name="delete-equipment{{ $equipment->id }}" :show="$errors->isNotEmpty()">
                            <div class="p-5 gap-2 flex flex-col items-center">
                                <h1>Are You Sure You Want To Delete This Equipment</h1>
                                <div>
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                    <button type="button"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                                        wire:click='delete({{ $equipment->id }})'>
                                        delete
                                    </button>
                                </div>
                            </div>
                        </x-modal>

                        <button wire:click='edit({{ $equipment->id }})'
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition"
                            x-on:click.prevent="$dispatch('open-modal', 'edit{{ $equipment->id }}' )">{{ __('edit') }}</button>
                        <x-modal name="edit{{ $equipment->id }}" :show="$errors->isNotEmpty()">
                            <div class="p-5 gap-2 flex flex-col items-center">
                                <form wire:submit='update({{ $equipment->id }})' class="flex flex-col items-center">
                                    <label class="flex flex-col gap-y-2">
                                        <span>reference :</span>
                                        <input type="text" wire:model="reference">
                                        @error('reference')
                                            <em class="text-red-500">{{ $message }}</em>
                                        @enderror
                                    </label>

                                    <label class="flex flex-col gap-y-2">
                                        <span>mark :</span>
                                        <input type="text" wire:model="mark">
                                        @error('mark')
                                            <em class="text-red-500">{{ $message }}</em>
                                        @enderror
                                    </label>

                                    <label class="flex flex-col gap-y-2">
                                        <span>equipment_type :</span>
                                        <select wire:model="equipment_type">
                                            <option disabled>choose equipment type</option>
                                            <option value="camera">camera</option>
                                            <option value="son">son</option>
                                            <option value="lumiere">lumiere</option>
                                            <option value="data/stockage">data/stockage</option>
                                            <option value="podcast">podcast</option>
                                            <option value="other">other</option>
                                        </select>
                                        @error('equipment_type')
                                            <em class="text-red-500">{{ $message }}</em>
                                        @enderror
                                    </label>
                                    <input type="file" wire:model="image">
                                    @error('image')
                                        <em class="text-red-500">{{ $message }}</em>
                                    @enderror
                                    <div>
                                        <button wire:click="cancel" type="button" x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </button>
                                        <button type="submit"
                                            class="text-white bg-blue-500 mt-2 p-3 rounded-lg">Update</button>
                                    </div>
                                </form>

                            </div>
                        </x-modal>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


{{--
<button class="text-red-500"
    x-on:click.prevent="$dispatch('open-modal', '')">{{ __('') }}</button>
<x-modal name="" :show="$errors->isNotEmpty()">
    <div class="p-5 gap-2 flex flex-col items-center">
        <div>
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal> --}}
