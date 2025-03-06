<form wire:submit.prevent="save" enctype="multipart/form-data">
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name:</label>
        <input type="text" wire:model="userForm.name" id="name" placeholder="Full Name"
            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
        @error('userForm.name')
            <em class="text-red-600">{{ $message }}</em>
        @enderror
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email:</label>
        <input type="email" wire:model="userForm.email" id="email" placeholder="Email"
            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
        @error('userForm.email')
            <em class="text-red-600">{{ $message }}</em>
        @enderror
    </div>

    <div class="flex gap-2">
        <div class="mb-4 w-full">
            <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Phone:</label>
            <input type="number" wire:model="userForm.phone" id="phone" placeholder="Phone Number"
                class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
            @error('userForm.phone')
                <em class="text-red-600">{{ $message }}</em>
            @enderror
        </div>

        <div class="mb-4 w-full">
            <label for="cin" class="block text-sm font-medium text-gray-300 mb-1">CIN:</label>
            <input type="text" wire:model="userForm.cin" id="cin" placeholder="CIN"
                class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none" />
            @error('userForm.cin')
                <em class="text-red-600">{{ $message }}</em>
            @enderror
        </div>
    </div>

    <div class="mb-4 w-full">
        <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Role:</label>
        <select wire:model="userForm.role" id="role"
            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            <option disabled>Select Role</option>
            <option value="Moderator">Moderator</option>
            <option value="Coworker">Coworker</option>
            <option value="Student">Student</option>
        </select>
        @error('userForm.role')
            <em class="text-red-600">{{ $message }}</em>
        @enderror
    </div>

    <div class="mb-4">
        <span class="pb-2 text-white">image :</span>
        <input type="file" accept="image/*" wire:model="userForm.image"
            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:border-none focus:ring-[#fee814] focus:outline-none">
            @error('userForm.image')
            <em class="text-red-600">{{ $message }}</em>
        @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Select
            Status:</label>
        <select wire:model="userForm.status" id="status"
            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            <option disabled>Select Status</option>
            <option value="Studying">Studying</option>
            <option value="Working">Working</option>
            <option value="Internship">Internship</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Freelancing">Freelancing</option>
        </select>
        @error('userForm.status')
            <em class="text-red-600">{{ $message }}</em>
        @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Select
            Formation:</label>
        <select wire:model="userForm.formation_id" id="status"
            class="w-full border border-gray-600 rounded-lg p-2 bg-gray-800 text-white focus:ring-2 focus:ring-[#fee814] focus:outline-none">
            <option disabled>Select Formation</option>
            @foreach ($formations as $formation)
                <option value="{{ $formation->id }}">{{ $formation->formation_name }}</option>
            @endforeach
        </select>
        @error('userForm.status')
            <em class="text-red-600">{{ $message }}</em>
        @enderror
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" x-on:click="$dispatch('close')"
            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-300">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 bg-[#fee814] text-black rounded-lg hover:bg-yellow-400 transition-colors duration-300">
            Create
        </button>
    </div>
</form>
