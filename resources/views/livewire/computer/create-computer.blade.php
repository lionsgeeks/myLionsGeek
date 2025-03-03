<div>
    <div class="flex justify-end">
        <button wire:click="toggleModal" class="p-2 bg-[#fee814] rounded-lg">+ Add Computer</button>
    </div>
    
    @if ($showModal)

        <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
            <div
                class="bg-gray-900 rounded-lg p-6 w-[90%] max-w-lg shadow-2xl transform transition-transform duration-300 scale-100">
                <h2 class="text-xl font-bold mb-4 text-[#fee814] border-b pb-2">Add Computer</h2>
                <form wire:submit.prevent="add">
                    <div class="mb-4">
                        <label for="reference" class="block text-sm font-medium text-gray-300 mb-1">Reference:</label>
                        <input type="text" wire:model="form.reference" id="reference" placeholder="Enter computer reference"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                    </div>
                    <div class="mb-4">
                        <label for="cpu/gpu" class="block text-sm font-medium text-gray-300 mb-1">CPU/GPU</label>
                        <input type="text" wire:model="form.CpuGpu" id="CpuGpu" placeholder="Enter computer CPU"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                    </div>
                
                    <div class="mb-4">
                        <label for="computer_state" class="block text-sm font-medium text-gray-300 mb-1">Computer State:</label>
                        <select wire:model="form.computer_state" id="computer_state"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                            <option value="working">Working</option>
                            <option value="not_working">Not Working</option>
                            <option value="damaged">Damaged</option>
                        </select>
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" wire:model="form.is_available" id="is_available" class="mr-2">
                        <label for="is_available" class="text-sm font-medium text-gray-300">Is Available:</label>
                    </div>
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-300 mb-1">Assigned User:</label>
                        <select wire:model="form.user_id" id="user_id"
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                            <option value="">None</option>
                            @foreach ($this->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-300 mb-1">Start Date:</label>
                        <input type="date" wire:model="form.start_date" id="start_date" required
                            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="cancel"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#fee814] text-black rounded-lg hover:bg-yellow-400 transition-colors duration-300">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
