<div>
    <h1 class="text-xl font-bold ">create computer</h1>

    <form wire:submit='add'>
        <div>
            <label for="">Computer Refrence</label>
            <input type="text" wire:model='form.reference' placeholder="enter computer refrence">
        </div>
        <div>
            <label for="">CPU</label>
            <input type="text" wire:model='form.cpu' placeholder="enter computer CPU">
        </div>
        <div>
            <label for="">GPU</label>
            <input type="text" wire:model='form.gpu' placeholder="enter computer Gpu">
        </div>
        <div>
            <label for="">Computer State</label>
            <select name="computer_state" wire:model='form.computer_state' id="">
                <option value="working">Working</option>
                <option value="not_working">Not Working</option>
                <option value="damaged">Damaged</option>
            </select>
        </div>
        <div>
            <label for="is_available">Is Available:</label>
            <input type="checkbox" wire:model='form.is_available' name="is_available" id="is_available" value="1">

        </div>
        <div>
            <label for="user_id">Assigned User:</label>
            <select name="user_id" wire:model='form.user_id' id="user_id">
                <option value="">None</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Start Date: </label>
            <input type="date" wire:model='form.start_date' name="start_date" id="start_date" required>
        </div>
        <div>
            <label for="device_name">Device Name:</label>
            <input type="text" wire:model='form.device_name' name="device_name" id="device_name" required>
        </div>
        <button type="submit">Add</button>
    </form>
    
</div>
