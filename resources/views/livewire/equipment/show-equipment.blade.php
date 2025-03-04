<div class="bg-[#171717] min-h-screen text-white flex flex-col p-8 gap-y-5 px-16">
    <div class="flex items-center justify-between ">
        <h1 class="text-3xl text-alpha font-bold">Equipment</h1>
        @if ($modal)
            <div class="w-full h-full flex items-center justify-center fixed left-0 top-0 bg-[#000000b3] z-30">
                <div class="p-5 gap-2 flex flex-col items-center bg-[#111827] min-w-[40vw] rounded-md ">
                    <form enctype="multipart/form-data" wire:submit='equipment' class="flex flex-col gap-y-3  w-full">
                        <h1 class="text-yellow-500 text-xl font-bold border-b pb-2">{{ $updateData ? "Edit Equipment" : "Create Equipment" }}</h1>
                        <label class="w-full">
                            <span class=" pb-2 ">reference :</span>
                            <input class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-alpha focus:outline-none" type="text" wire:model="reference">
                            @error('reference')
                                <em class="text-red-500">{{ $message }}</em>
                            @enderror
                        </label>

                        <label class="w-full">
                            <span class=" pb-2 ">mark :</span>
                            <input class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-alpha focus:outline-none" type="text" wire:model="mark">
                            @error('mark')
                                <em class="text-red-500">{{ $message }}</em>
                            @enderror
                        </label>

                        <label class="w-full">
                            <span class=" pb-2 ">equipment_type :</span>
                            <select class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-alpha focus:outline-none" wire:model="equipment_type">
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
                            <input type="file" accept="image/*" multiple wire:model="images"  class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-alpha focus:outline-none" >
                            @error('images')
                                <em class="text-red-500">{{ $message }}</em>
                            @enderror

                        </label>
                        <div class="flex items-center justify-end gap-x-3 ">
                            <button class="px-4 py-2 bg-gray-600 text-white rounded-lg  transition-colors duration-300" wire:click="cancel" type="button" x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="text-white bg-yellow-500  px-4 py-2 rounded-lg">{{ $updateData ? "Update": "Create" }}</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
    <div class="flex justify-between w-full mt-5">
        <div class="flex justify-start items-center gap-x-3">
            <input
                class="w-[20vw] bg-[#2E2E2E] focus:ring-2 focus:border-none focus:ring-alpha focus:outline-none rounded-md placeholder:text-white"
                type="text" wire:model.live="search" placeholder="search">
            <select
                class="w-[18vw] bg-[#2E2E2E] focus:ring-2 focus:border-none focus:ring-alpha focus:outline-none rounded-md"
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
            <button class="px-4 py-2 w-1/3 bg-yellow-500 text-black font-semibold rounded-md  transition"
                wire:click="resetSearch">Reset Filter</button>
        </div>
        <div>
            <button class="px-4 py-2 bg-yellow-500 text-black font-semibold rounded-md  transition"
                    wire:click="$set('modal' , true)">{{ __('+ Add Equipment') }}</button>


        </div>
    </div>

    <div class="grid grid-cols-4 items-center justify-start gap-5 mt-8">
        @foreach ($equipments as $equipment)
            <div class="flex flex-col h-[40vh] bg-[#2E2E2E] rounded-md relative ">

                    <div class="overflow-hidden">
                        @if ($equipment->images->count() > 1)
                            <x-carousel :images="$equipment->images" />
                        @else
                            <img class="rounded-t-md" src="{{ asset('storage/images/equipment/' . $equipment->images->first()->path ) }}" alt="" >
                        @endif
                    </div>
                <div class="flex items-center justify-between p-4">
                    <div class="flex flex-col">
                        <h1 class="">Reference : <span class="text-yellow-500">{{ $equipment->reference }}</span>
                        </h1>
                        <h1 class="">Mark : <span class="text-yellow-500">{{ $equipment->mark }}</span></h1>
                        <h1 class="">Equipment Type : <span
                                class="text-yellow-500">{{ $equipment->equipment_type }}</span></h1>
                        <h1 class="">State : <span class="text-yellow-500">{{ $equipment->state === 1 ? "khdam" : "khasar" }}</span></h1>
                    </div>
                    <div class="flex flex-col items-center absolute right-0 top-1 z-20">
                        <button class=""
                            wire:click="confirmDelete({{ $equipment->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ef4444" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg>
                        </button>
                        @if ($deleteModal === $equipment->id)
                            <div class="w-full h-full flex items-center justify-center fixed left-0 top-0 bg-[#000000b3]  ">
                                <div class="p-5 gap-2 flex flex-col items-center bg-[#111827] min-w-[30vw] rounded-md ">
                                    <h1>Are You Sure You Want To Delete This Equipment</h1>
                                    <div>
                                        <button wire:click="$set('deleteModal', null)" class="px-4 py-2 bg-gray-600 text-white rounded-lg  transition-colors duration-300">
                                            {{ __('Cancel') }}
                                        </button>
                                        <button type="button"
                                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                                            wire:click='delete({{ $equipment->id }})'>
                                            delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <button wire:click='edit({{ $equipment->id }})'
                            class="px-4 py-2 "
                            ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.1 2.1 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621"/><path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3"/></g></svg></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $equipments->links() }}



</div>


