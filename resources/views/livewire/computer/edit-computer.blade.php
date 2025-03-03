<div class="p-6 ml-24">
    <h1 class="text-xl font-bold text-[#fee814] border-b pb-2 mb-4">Edit Computer</h1>
    <form wire:submit.prevent='editComputer' class="space-y-4 flex flex-col gap-8 ">
        <div class="flex gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Computer Reference</label>
                <input type="text" wire:model='form.reference' placeholder="Enter computer reference"
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">CPU</label>
                <input type="text" wire:model='form.CpuGpu' placeholder="Enter computer CPU"
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            </div>
        </div>
     
        <div class="flex gap-[35vw]">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Computer State</label>
                <select wire:model='form.computer_state'
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                    <option value="working">Working</option>
                    <option value="not_working">Not Working</option>
                    <option value="damaged">Damaged</option>
                </select>
            </div>
            <div class="flex items-center pl-1">
                <input type="checkbox" wire:model='form.is_available' id="is_available" class="mr-2">
                <label for="is_available" class="text-sm font-medium text-gray-300">Is Available</label>
            </div>
            
        </div>
        <div class="flex gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Assigned User</label>
                <select wire:model='form.user_id'
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                    <option value="">None</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Start Date</label>
                <input type="date" wire:model='form.start_date' required
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            </div>
      
        </div>
        <div class="mt-6 flex justify-end mr-36">
            <button type="submit"
                class="px-6 py-2 bg-[#fee814] text-black font-semibold rounded-lg hover:bg-yellow-400 transition duration-300">
                Edit
            </button>
        </div>
    </form>
</div>
