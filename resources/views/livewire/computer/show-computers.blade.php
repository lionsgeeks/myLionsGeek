<div class="container mx-auto ">
    <h2 class="text-xl font-bold mb-4 text-[#fee814] border-b pb-2">Computers List</h2>
    {{-- Search Form --}}
    <div class="mb-4 flex justify-end gap-3">
        {{-- Search Input --}}
        <input type="text" wire:model.live='search' placeholder="Search by reference, CPU, GPU, or device name"
            class="border border-gray-600 p-2 rounded-lg w-full md:w-1/6 bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none placeholder:text-sm">

        {{-- Computer State Filter --}}
        <select name="computer_state" wire:model.live="computerState"
            class="border border-gray-600 p-2 rounded-lg w-full text-sm md:w-[8.5vw] bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            <option value="">Filter by State</option>
            <option value="working">Working</option>
            <option value="not_working">Not Working</option>
            <option value="damaged">Damaged</option>
        </select>

        {{-- Availability Filter --}}
        <select wire:model.live="is_available" name="is_available"
            class="border border-gray-600 p-2 rounded-lg w-full text-sm md:w-[10.5vw] bg-[#2E2E2E] text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            <option value="">Filter by Availability</option>
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select>

        {{-- Submit Button --}}
        <button type="submit"
            class="bg-[#fee814] text-black px-3 py-2 rounded-lg hover:bg-yellow-400 transition-colors duration-300"
            wire:click='resetFilter'>Reset Filter</button>
    </div>

    <div class="container mx-auto h-full">
        <div class="">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#2E2E2E] text-white text-sm">
                        <th class="py-2 px-4"></th>
                        <th class="py-2 px-4 text-center">ID</th>
                        <th class="py-2 px-10">Reference</th>
                        <th class="py-2 px-4">CPU/GPU</th>
                        <th class="py-2 px-4 text-center">State</th>
                        <th class="py-2 px-4 text-center">Available</th>
                        <th class="py-2 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($computers as $computer)
                        <tr class="border-b border-gray-700 text-white">
                            <td class="py-2 px-3"><i class="fa-solid fa-grip text-gray-500"></i></td>
                            <td class="py-2 px-3 text-center">{{ $computer->id }}</td>
                            <td class="py-2 px-10">{{ $computer->reference }}</td>
                            <td class="py-2 px-3">{{ $computer->CpuGpu }}</td>
                            <td
                                class="py-2 px-3 text-sm font-semibold text-center 
                                {{ $computer->computer_state == 'working' ? 'text-green-400' : ($computer->computer_state == 'not_working' ? 'text-yellow-400' : 'text-red-400') }}">
                                {{ ucfirst($computer->computer_state) }}
                            </td>
                            <td class="py-2 px-3 text-center">
                                {{ $computer->is_available ? '✅' : '' }}
                                @if (!$computer->is_available && $computer->user)
                                    <a href="#">
                                        {{ $computer->user->name }}
                                    </a>
                                @endif
                            </td>
                            <td class="py-2 px-3 text-center space-x-2">
                                <button wire:navigate href="/computer/update/{{ $computer->id }}" class="text-gray-500">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" wire:click="delete({{ $computer->id }})">
                                    🗑
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
