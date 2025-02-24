<div id="modaledit" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center ">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <form wire:submit='create' class="flex flex-col items-center">
            <label class="flex flex-col gap-y-2">
                <span>reference :</span>
                <input type="text" wire:model="reference">
                @error('reference')
                    <em class="text-red-500">{{ $message }}</em>
                @enderror
            </label>

            <label class="flex flex-col gap-y-2">
                <span>mark :</span>
                <input type="text" wire:model="mark">
                @error('mark')
                    <em class="text-red-500">{{ $message }}</em>
                @enderror
            </label>

            <label class="flex flex-col gap-y-2">
                <span>equipment_type :</span>
                <select wire:model="equipment_type">
                    <option disabled selected>choose equipment type</option>
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

            <button class="text-white bg-blue-500 mt-2 p-3 rounded-lg">Create</button>
        </form>
        <button id="closeModaledit"
            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">Close</button>
    </div>

</div>

<script>
    const modaledit = document.getElementById('modaledit');
    const openModaledit = document.getElementById('openModaledit');
    const closeModaledit = document.getElementById('closeModaledit');

    openModaledit.addEventListener('click', () => {
        modaledit.classList.remove('hidden');
        modaledit.classList.add('flex');
    });

    closeModaledit.addEventListener('click', () => {
        modaledit.classList.add('hidden');
        modaledit.classList.remove('flex');
    });
</script>
