<div class=" w-full flex justify-center p-8">
    <form wire:submit='save' class="w-[50%]  flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <label>Full name :</label>
            <input wire:model="userForm.name" type="text">
            @error('userForm.name')
                {{ $message }}
            @enderror
        </div>
        <div class="flex flex-col gap-2">
            <label>Email :</label>
            <input wire:model="userForm.email" type="email">
            @error('userForm.email')
                <em class="text-red-600">
                    {{ $message }}
                </em>
            @enderror
        </div>
        <div class="flex flex-col gap-2">
            <label>Phone :</label>
            <input wire:model="userForm.phone" type="number">
            @error('userForm.phone')
                <em class="text-red-600">
                    {{ $message }}
                </em>
            @enderror
        </div>
        <div class="flex flex-col gap-2">
            <label>Cin :</label>
            <input wire:model="userForm.cin" type="text">
            @error('userForm.cin')
                <em class="text-red-600">
                    {{ $message }}
                </em>
            @enderror
        </div>
        <div class="flex flex-col gap-2">
            <label>Role :</label>
            <select wire:model="userForm.role">
                <option disabled >Select Role</option>
                <option value="Moderator">Moderator</option>
                <option value="Coworker">Coworker</option>
                <option value="Student">Student</option>
            </select>
            @error('userForm.role')
                <em class="text-red-600">
                    {{ $message }}
                </em>
            @enderror
        </div>
        <div class="flex flex-col gap-2">
            <label for="">Select Status :</label>
            <select wire:model="userForm.status">
                <option disabled >Select Status</option>
                <option value="Studying">Studying</option>
                <option value="Working">Working</option>
                <option value="Internship">Internship</option>
                <option value="Unemployed">Unemployed</option>
                <option value="Freelancing">Freelancing</option>
            </select>
            @error('userForm.status')
                <em class="text-red-600">
                    {{ $message }}
                </em>
            @enderror
        </div>
        <button class="bg-black text-white w-fit py-2 rounded  px-5" type="submit">Create</button>
    </form>
</div>
