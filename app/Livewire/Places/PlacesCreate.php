<?php

namespace App\Livewire\Places;

use App\Models\Places;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PlacesCreate extends Component
{
    use WithFileUploads;

    public $name = "";
    public $place_type = "";
    public $state;
    public $places;
    public $image;
    public $selectedPlaceId = null;
    public $showModal = false;
    public $updateData = false;


    public function add()
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'place_type' => 'required|string',
            'state' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['image'] = $this->image ? $this->image->store('places', 'public') : null;

        if ($this->selectedPlaceId) {

            $place = Places::findOrFail($this->selectedPlaceId);
            $place->update($validated);
        } else {

            Places::create($validated);
        }

        $this->reset(['name', 'place_type', 'state', 'image', 'selectedPlaceId']);

        $this->places = Places::all();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $place = Places::find($id);

        $this->selectedPlaceId = $id;
        $this->name = $place->name;
        $this->place_type = $place->place_type;
        $this->state = $place->state;
        $this->image = null;
        $this->updateData = true;
        $this->showModal = true;
    }


    public function update()
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'place_type' => 'required|string',
            'state' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $place = Places::find($this->selectedPlaceId);
        $place->update($validated);

        $this->reset(['name', 'place_type', 'state', 'image', 'selectedPlaceId', 'updateData']);
        $this->showModal = false;

        $this->places = Places::all();
    }

    public function cancel()
    {
        $this->reset(['name', 'place_type', 'state', 'image', 'selectedPlaceId', 'updateData']);
        $this->showModal = false;
    }


    public function delete(Places $place)
    {
        $place->delete();
        $this->places = Places::all();
    }


    public function render()
    {
        $this->places = Places::all();
        return view('livewire.places.places-create');
    }
}
