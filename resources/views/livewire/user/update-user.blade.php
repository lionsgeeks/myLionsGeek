<div class="p-6 ml-24">
    <h1 class="text-xl font-bold text-[#fee814] border-b pb-2 mb-4">Edit User</h1>
    <form wire:submit.prevent='save' class="space-y-4 flex flex-col gap-8">
        <div class="flex gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                <input type="text" wire:model='userForm.name' placeholder="Enter full name"
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                @error('userForm.name')
                    <em class="text-red-600 text-sm">{{ $message }}</em>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" wire:model='userForm.email' placeholder="Enter email"
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                @error('userForm.email')
                    <em class="text-red-600 text-sm">{{ $message }}</em>
                @enderror
            </div>
        </div>
        <div class="flex gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                <input type="number" wire:model='userForm.phone' placeholder="Enter phone number"
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                @error('userForm.phone')
                    <em class="text-red-600 text-sm">{{ $message }}</em>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">CIN</label>
                <input type="text" wire:model='userForm.cin' placeholder="Enter CIN"
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                @error('userForm.cin')
                    <em class="text-red-600 text-sm">{{ $message }}</em>
                @enderror
            </div>
        </div>
        <div class="flex gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Role</label>
                <select wire:model='userForm.role'
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                    <option disabled selected>Select Role</option>
                    <option value="Moderator">Moderator</option>
                    <option value="Coworker">Coworker</option>
                    <option value="Student">Student</option>
                </select>
                @error('userForm.role')
                    <em class="text-red-600 text-sm">{{ $message }}</em>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                <select wire:model='userForm.status'
                    class="w-[40vw] border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
                    <option disabled selected>Select Status</option>
                    <option value="Studying">Studying</option>
                    <option value="Working">Working</option>
                    <option value="Internship">Internship</option>
                    <option value="Unemployed">Unemployed</option>
                    <option value="Freelancing">Freelancing</option>
                </select>
                @error('userForm.status')
                    <em class="text-red-600 text-sm">{{ $message }}</em>
                @enderror
            </div>
        </div>
        <div class="mt-6 flex justify-end mr-36">
            <button type="submit"
                class="px-6 py-2 bg-[#fee814] text-black font-semibold rounded-lg hover:bg-yellow-400 transition duration-300">
                Update
            </button>
        </div>
    </form>
</div>
