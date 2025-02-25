<div class="bg-[#171717] min-h-screen text-white flex flex-col p-8 gap-y-5">
    <div class="flex items-center justify-between ">
        <h1 class="text-3xl text-[#fee814] font-bold">Equipment</h1>
        <x-modal name="modal" :show="$errors->isNotEmpty()">
            <div class="p-5 gap-2 flex flex-col items-center bg-[#111827] ">
                <form wire:submit='create' class="flex flex-col gap-y-3  w-full">
                    <h1 class="text-yellow-500 text-xl font-bold border-b pb-2">Create Equipment</h1>
                    <label class="w-full">
                        <span class=" pb-2 ">reference :</span>
                        <input
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none"
                            type="text" wire:model="reference">
                        @error('reference')
                            <em class="text-red-500">{{ $message }}</em>
                        @enderror
                    </label>

                    <label class="w-full">
                        <span class=" pb-2 ">mark :</span>
                        <input
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none"
                            type="text" wire:model="mark">
                        @error('mark')
                            <em class="text-red-500">{{ $message }}</em>
                        @enderror
                    </label>

                    <label class="w-full">
                        <span class=" pb-2 ">equipment_type :</span>
                        <select
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none"
                            wire:model="equipment_type">
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

                    <label class="w-full">
                        <span class=" pb-2 ">image :</span>
                        <input
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none"
                            type="file" wire:model="image">
                        @error('image')
                            <em class="text-red-500">{{ $message }}</em>
                        @enderror
                        @if ($image)
                            <img width="250" src="{{ $image->temporaryUrl() }}">
                        @endif
                    </label>
                    <div class="flex items-center justify-end gap-x-3 ">
                        <button class="px-4 py-2 bg-gray-600 text-white rounded-lg  transition-colors duration-300"
                            wire:click="cancel" type="button" x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="text-white bg-yellow-500  px-4 py-2 rounded-lg">Create</button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
    <div class="flex justify-between w-full mt-5">
        <div class="flex justify-start items-center gap-x-3">
            <input
                class="w-[20vw] bg-[#2E2E2E] focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none rounded-md placeholder:text-white"
                type="text" wire:model.live="search" placeholder="search">
            <select
                class="w-[18vw] bg-[#2E2E2E] focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none rounded-md"
                wire:model.live="equipmentType">
                <option disabled>choose equipment type</option>
                <option value="all">all</option>
                <option value="camera">camera</option>
                <option value="son">son</option>
                <option value="lumiere">lumiere</option>
                <option value="data/stockage">data/stockage</option>
                <option value="podcast">podcast</option>
                <option value="other">other</option>
            </select>
            <button class="px-4 py-2 w-1/3 bg-yellow-500 text-black rounded-md  transition"
                wire:click="resetSearch">Reset Filter</button>
        </div>
        <div>
            <button class="px-4 py-2 bg-yellow-500 text-black rounded-md  transition"
                x-on:click.prevent="$dispatch('open-modal', 'modal' )">{{ __('+ Add equipment') }}</button>

        </div>
    </div>


    <div class="flex flex-wrap items-center justify-start gap-5 mt-8">
        @foreach ($equipments as $equipment)
            <div class="flex flex-col w-[30vw] min-h-[40vh] bg-[#2E2E2E] rounded-md relative">
                <div class="flex flex-col  items-center absolute right-0 top-1">
                    <button class=""
                        x-on:click.prevent="$dispatch('open-modal', 'delete-equipment{{ $equipment->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="#ef4444"
                                d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                        </svg>
                    </button>
                    <x-modal name="delete-equipment{{ $equipment->id }}" :show="$errors->isNotEmpty()">
                        <div class="p-5 gap-2 flex flex-col items-center bg-[#111827]">
                            <h1>Are You Sure You Want To Delete This Equipment</h1>
                            <div>
                                <button x-on:click="$dispatch('close')"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-lg  transition-colors duration-300">
                                    {{ __('Cancel') }}
                                </button>
                                <button type="button"
                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                                    wire:click='delete({{ $equipment->id }})'>
                                    delete
                                </button>
                            </div>
                        </div>
                    </x-modal>

                    <button wire:click='edit({{ $equipment->id }})' class="px-2 py-2 "
                        x-on:click.prevent="$dispatch('open-modal', 'edit{{ $equipment->id }}' )"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2">
                                <path
                                    d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.1 2.1 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621" />
                                <path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
                            </g>
                        </svg></button>
                    <x-modal name="edit{{ $equipment->id }}" :show="$errors->isNotEmpty()">
                        <div class="p-5 gap-2 flex flex-col items-center bg-[#111827]">
                            <form wire:submit='update({{ $equipment->id }})'
                                class="flex flex-col w-full gap-y-3">
                                <h1 class="text-yellow-500 text-xl font-bold border-b pb-2">Edit Equipment</h1>
                                <label class="flex flex-col gap-y-2">
                                    <span>reference :</span>
                                    <input type="text" wire:model="reference"
                                        class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none">
                                    @error('reference')
                                        <em class="text-red-500">{{ $message }}</em>
                                    @enderror
                                </label>

                                <label class="flex flex-col gap-y-2">
                                    <span>mark :</span>
                                    <input type="text" wire:model="mark"
                                        class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none">
                                    @error('mark')
                                        <em class="text-red-500">{{ $message }}</em>
                                    @enderror
                                </label>

                                <label class="flex flex-col gap-y-2">
                                    <span>equipment_type :</span>
                                    <select wire:model="equipment_type"
                                        class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none">
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
                                <label class="w-full">
                                    <input type="file" wire:model="image"
                                        class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none">
                                    @error('image')
                                        <em class="text-red-500">{{ $message }}</em>
                                    @enderror
                                </label>
                                <div class="flex items-center justify-end gap-x-3">
                                    <button wire:click="cancel" type="button" x-on:click="$dispatch('close')"
                                        class="px-4 py-2 bg-gray-600 text-white rounded-lg  transition-colors duration-300">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button type="submit"
                                        class="text-white bg-yellow-500  px-4 py-2 rounded-lg">Update</button>
                                </div>
                            </form>

                        </div>
                    </x-modal>
                </div>
                <div class="">
                    @foreach ($equipment->images as $image)
                        <img class="rounded-t-md" src="{{ asset('storage/' . $image->path) }}" alt="">
                    @endforeach
                </div>
                <div class="flex items-center justify-between p-4">
                    <div class="flex flex-col">
                        <h1 class="">Reference : <span class="text-yellow-500">{{ $equipment->reference }}</span>
                        </h1>
                        <h1 class="">Mark : <span class="text-yellow-500">{{ $equipment->mark }}</span></h1>
                        <h1 class="">Equipment Type : <span
                                class="text-yellow-500">{{ $equipment->equipment_type }}</span></h1>
                        <h1 class="">State : <span class="text-yellow-500">{{ $equipment->state }}</span></h1>
                    </div>
                
                </div>
            </div>
        @endforeach
    </div>



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
