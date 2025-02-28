<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;
use Livewire\WithFileUploads;

class ShowEquipment extends Component
{
    use WithFileUploads;

    public $search = '' , $equipmentType ;

    // #[Rule('required', message: 'please enter reference')]
    public $reference = '';

    // #[Rule('required', message: 'please enter mark')]
    public $mark = '';

    // #[Rule('required', message: 'please choose equipment type')]
    public $equipment_type = '';

    // #[Rule('required', message: 'please choose image')]
    public $images;

    public $selectedEquipmentId;
    public $updateData=false;
    public $modal = false;
    public $deleteModal = null ;

    // create equipment
    public function equipment () {

        // $this->validate();
        $validate = $this->validate([
            'reference' => 'required',
            'mark' => 'required',
            'equipment_type' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($this->updateData) {
            $equipment = Equipment::findOrFail($this->selectedEquipmentId);
            $equipment->update($validate);


            if ($this->images) {
                foreach ($equipment->images as $image) {
                    $image->erase("equipment");
                }
                Image::store($equipment, $this->images, 'equipment');
            }

        } else {
            $equipment = Equipment::create($validate);
            Image::store($equipment, $this->images, 'equipment');

        }

        $this->resetForm();
    }

    // Edit Equipment
    public function edit(Equipment $equipment)
    {
        $this->selectedEquipmentId = $equipment->id;
        $this->updateData = true;
        $this->modal = true;
        $this->reference = $equipment->reference;
        $this->mark = $equipment->mark;
        $this->equipment_type = $equipment->equipment_type;
        // $this->images = $equipment->images()->first()->path;
    }

    // update equipment
    // public function update(Equipment $equipment)
    // {
    //     $this->validate();

    //         $equipment->update([
    //             'reference' => $this->reference,
    //             'mark' => $this->mark,
    //             'equipment_type' => $this->equipment_type,
    //         ]);

    //         if ($this->images) {
    //             $storage = Storage::disk("public");

    //             // Delete old image if exists
    //             $oldImage = $equipment->images->first();
    //             if ($oldImage) {
    //                 $storage->delete($oldImage->path);
    //                 $oldImage->delete();
    //             }

    //             // Store new image
    //             $newImagePath = $this->images->store("images/equipment", "public");

    //             // Save new image in the morph table
    //             $equipment->images()->create([
    //                 'path' => $newImagePath,
    //             ]);
    //         }
    //         $this->resetForm();
    // }

    // confirm delete
    public function confirmDelete($id)
    {
        $this->deleteModal = $id;
    }

    // delete equipment
    public function delete (Equipment $equipment) {
        foreach ($equipment->images as $image) {
            $image->erase("equipment");
        }
        $equipment->delete();
    }

    public function cancel() {
        $this->resetForm();
    }

    // reset form
    private function resetForm()
    {
        $this->reference = '';
        $this->mark = '';
        $this->equipment_type = '';
        $this->images = null;
        $this->modal = false;
        $this->resetValidation();
    }

    // reset search
    public function resetSearch(){
        $this->reset();
    }

    public function render()
    {
        $EquipmentQuery = Equipment::query();

        if ($this->search) {
            $EquipmentQuery->where(function ($query) {
                $query->where('reference', 'like', '%' . $this->search . '%')
                    ->orWhere('mark', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->equipmentType && $this->equipmentType !== 'all') {
            $EquipmentQuery->where(function ($query) {
                $query->where('equipment_type', 'like', '%' . $this->equipmentType . '%');
            });
        }
        return view('livewire.equipment.show-equipment', [
            'equipments' => $EquipmentQuery->paginate(8)
        ]);
    }
}
