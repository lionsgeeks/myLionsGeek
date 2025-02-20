<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Computers List</h2>
    {{-- Search Form --}}
    <div class="mb-4 flex flex-wrap gap-4">
        {{-- Search Input --}}
        <input type="text" wire:model.live='search' placeholder="Search by reference, CPU, GPU, or device name"
            class="border p-2 rounded w-full md:w-1/3">

        {{-- Computer State Filter --}}
        <select name="computer_state" wire:model.live="computerState" class="border p-2 rounded w-full md:w-1/4">
            <option value="">Filter by State</option>
            <option value="working" >Working</option>
            <option value="not_working">Not
                Working</option>
            <option value="damaged" >Damaged</option>
        </select>

        {{-- Availability Filter --}}
        <select wire:model.live="is_available" name="is_available" class="border p-2 rounded w-full md:w-1/4">
            <option value="">Filter by Availability</option>
            <option value="1" >Available</option>
            <option value="0" >Not Available</option>
        </select>

        {{-- Submit Button --}}
        <button type="submit"  class="bg-blue-500 text-white px-4 py-2 rounded" wire:click='resetFilter'>Reset Filter</button>
    </div>
    <div class="container mx-auto p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border">ID</th>
                        <th class="py-2 px-4 border">Reference</th>
                        <th class="py-2 px-4 border">CPU</th>
                        <th class="py-2 px-4 border">GPU</th>
                        <th class="py-2 px-4 border">State</th>
                        <th class="py-2 px-4 border">Available</th>
                        <th class="py-2 px-4 border">User ID</th>
                        <th class="py-2 px-4 border">Start Date</th>
                        <th class="py-2 px-4 border">Device Name</th>
                        <th class="py-2 px-4 border">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($computers as $computer)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="py-2 px-4 border text-center">{{ $computer->id }}</td>
                            <td class="py-2 px-4 border text-center">{{ $computer->reference }}</td>
                            <td class="py-2 px-4 border text-center">{{ $computer->cpu }}</td>
                            <td class="py-2 px-4 border text-center">{{ $computer->gpu }}</td>
                            <td
                                class="py-2 px-4 border text-center font-semibold {{ $computer->computer_state == 'working' ? 'text-green-600' : ($computer->computer_state == 'not_working' ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ ucfirst($computer->computer_state) }}
                            </td>
                            <td class="py-2 px-4 border text-center">
                                {{ $computer->is_available ? '✅' : '❌' }}
                            </td>
                            <td class="py-2 px-4 border text-center">{{ $computer->user->name }}</td>
                            <td class="py-2 px-4 border text-center">{{ $computer->start_date }}</td>
                            <td class="py-2 px-4 border text-center">{{ $computer->device_name }}</td>
                            <td class="flex flex-col gap-y-2 p-2">
                                <button type="button" wire:click='delete({{ $computer->id }})'
                                    wire:confirm='Are you sure you want to delete this computer?'
                                    class="bg-red-400 px-4 font-bold rounded-md">
                                    Delete
                                </button>
                                <button wire:navigate href="/computer/update/{{ $computer->id }}"
                                    class="bg-green-400 px-4 font-bold rounded-md">
                                    Update
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
