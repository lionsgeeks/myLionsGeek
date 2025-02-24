<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;
use Livewire\WithFileUploads;

class ShowEquipment extends Component
{
    use WithFileUploads;

    public $search = '' , $equipmentType ;

    #[Rule('required', message: 'please enter reference')]
    public $reference = '';

    #[Rule('required', message: 'please enter mark')]
    public $mark = '';

    #[Rule('required', message: 'please choose equipment type')]
    public $equipment_type = '';

    #[Rule('required', message: 'please choose image')]
    public $image;


    // create equipment
    public function create () {

        $this->validate();

        // $image = $this->image;

        // $imageName = hash("sha256", file_get_contents($image)) . "." . $image->getClientOriginalExtension();

        // $image->move(storage_path("app/public/images"), $imageName);

        $image = $this->image->store("images/equipment", "public");

        $equipment = Equipment::create([
            'reference' => $this->reference,
            'mark' => $this->mark,
            'equipment_type' => $this->equipment_type,
        ]);
        $equipment->images()->create([
            'path' => $image
        ]);

        $this->resetForm();
    }

    // Edit Equipment
    public function edit(Equipment $equipment)
    {
        $this->reference = $equipment->reference;
        $this->mark = $equipment->mark;
        $this->equipment_type = $equipment->equipment_type;
        // $this->image = $equipment->images->first()->path;
    }

    // update equipment
    public function update(Equipment $equipment)
    {
        $this->validate();

            $equipment->update([
                'reference' => $this->reference,
                'mark' => $this->mark,
                'equipment_type' => $this->equipment_type,
            ]);

            if ($this->image) {
                $storage = Storage::disk("public");

                // Delete old image if exists
                $oldImage = $equipment->images->first();
                if ($oldImage) {
                    $storage->delete($oldImage->path);
                    $oldImage->delete();
                }

                // Store new image
                $newImagePath = $this->image->store("images/equipment", "public");

                // Save new image in the morph table
                $equipment->images()->create([
                    'path' => $newImagePath,
                ]);
            }
            $this->resetForm();
    }

    // delete equipment
    public function delete (Equipment $equipment) {
        // $path = $equipment->images->first()->path;
        // $storage = Storage::disk("public");

        // if ($storage->exists($path)) {
        //     $storage->delete($path);
        //     $equipment->delete();
        // }
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
        $this->image = null;
    }

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
        if ($this->equipmentType) {
            $EquipmentQuery->where(function ($query) {
                $query->where('equipment_type', 'like', '%' . $this->equipmentType . '%');
            });
        }
        return view('livewire.equipment.show-equipment', [
            'equipments' => $EquipmentQuery->get()
        ]);
    }
}
