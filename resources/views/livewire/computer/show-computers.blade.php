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
            <option value="" >Filter by State</option>
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
        <button type="submit" class="bg-[#fee814] text-black px-3 py-2 rounded-lg hover:bg-yellow-400 transition-colors duration-300"
            wire:click='resetFilter'>Reset Filter</button>
    </div>

    <div class="container mx-auto h-full">
        <div class="">
            <table class="min-w-full bg-gray-900 border border-gray-700">
                <thead class="">
                    <tr class="bg-[#2E2E2E] text-white text-sm ">
                        <th class="py-2 px-4 border border-gray-700">ID</th>
                        <th class="py-2 px-4 border border-gray-700">Reference</th>
                        <th class="py-2 px-4 border border-gray-700">CPU</th>
                        <th class="py-2 px-4 border border-gray-700">GPU</th>
                        <th class="py-2 px-4 border border-gray-700">State</th>
                        <th class="py-2 px-4 border border-gray-700">Available</th>
                        <th class="py-2 px-4 border border-gray-700">User ID</th>
                        <th class="py-2 px-4 border border-gray-700">Start Date</th>
                        <th class="py-2 px-4 border border-gray-700">Device Name</th>
                        <th class="py-2 px-4 border border-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($computers as $computer)
                        <tr class="{{ $loop->even ? 'bg-[#2E2E2E]' : 'bg-[#454545]' }} text-white ">
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">{{ $computer->id }}</td>
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">{{ $computer->reference }}</td>
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">{{ $computer->cpu }}</td>
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">{{ $computer->gpu }}</td>
                            <td
                              class="py-2 px-4 border border-gray-600 text-center font-semibold {{ $computer->computer_state == 'working' ? 'text-green-400' : ($computer->computer_state == 'not_working' ? 'text-yellow-400' : 'text-red-400') }}">
                                {{ ucfirst($computer->computer_state) }}
                            </td>
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">
                                {{ $computer->is_available ? '✅' : '❌' }}
                            </td>
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">{{ $computer->user->name }}</td>
                            <td class="text-xs py-2 px-4 border border-gray-600 text-center">{{ $computer->start_date }}</td>
                            <td class="text-sm py-2 px-4 border border-gray-600 text-center">{{ $computer->device_name }}</td>
                            <td class="text-sm flex flex-col gap-y-1 p-2">
                                <button wire:navigate href="/computer/update/{{ $computer->id }}"
                                    class=" text-blue-500 px-4 py-2 rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" wire:click="delete({{ $computer->id }})"
                                    class="text-red-500 px-4 py-2 rounded-lg">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>